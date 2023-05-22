<?php
try{
	$dbh= new PDO('mysql:host=localhost;dbname=rdgames_newdatabase;charset=utf8','rdgames_newdatabase','rdgames_newdatabase');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//$connection='connection successful';
     
	function testinput($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	
	
	$key=testinput($_POST["key"]);
	$name = testinput($_POST["name"]);
    $username = testinput($_POST["username"]);
    $mobileno= testinput($_POST["mobile"]);
    $password= testinput($_POST["password"]);
    $address = testinput($_POST["address"]);
    $city = testinput($_POST["city"]);
    $pincode = testinput($_POST["pin"]);
    $accountno = testinput($_POST["accountno"]);
    $bankname = testinput($_POST["bankname"]);
    $ifsc = testinput($_POST["ifsc"]);
    $accountholdername= testinput($_POST["accountholder"]);
    $tez = testinput($_POST["tez"]);
    $paytm = testinput($_POST["paytm"]);
    $phonepay = testinput($_POST["phonepay"]);
      $dob = testinput($_POST["dob"]);
         $email = testinput($_POST["email"]);
    if($key==2)
    $q="update user_profile set address='$address',city='$city',pincode='$pincode' where mobileno='$mobileno'";
    else if($key==3)
    $q="update user_profile set accountno='$accountno',bank_name='$bankname',ifsc_code='$ifsc',account_holder_name='$accountholdername' where mobileno='$mobileno'";
    else if($key==4)
    $q="update user_profile set tez_no='$tez',paytm_no='$paytm',phonepay_no='$phonepay' where mobileno='$mobileno'";
    else if($key==5)
    $q="update user_profile set email='$email',dob='$dob' where mobileno='$mobileno'";
    // else if($key==6)
    // $q="update user_profile set phonepay_no='$phonepay' where mobileno='$mobileno'";
    
if($key != 1 && $dbh->exec($q)){
$status="success";
}
else{
$status="unsuccessful";
}

    
    if($key==1){
    $stmt=$dbh->query("select count(*) as usern,user_profile.* from user_profile where mobileno='$mobileno'");
    $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if($results[0]["usern"]=="0") {
        $q="INSERT into user_profile(name,username,mobileno,password) VALUES ('$name', '$username', '$mobileno','$password')";
        if($dbh->exec($q))
            $status="success";
        else
            $status="unsuccessful";
        
        $ids = $dbh->lastInsertId();
        //  $stmt1=$dbh->query("select id from user_profile where email='$email'");
        // $results1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
        //echo $results1;    //    echo $r1=$results1[0]["usern"];
        $q1="INSERT into tblwallet(user_id,wallet_points) VALUES ($ids, 0)";
        $dbh->exec($q1);
    } else {
        $status="unsuccessful";
    
        if($results[0]["mobileno"]==$mobileno)
            $connection="Mobile number already exists";
    }
}

    
$obj=array('status'=>$status,'message'=>$connection);
echo json_encode($obj);


}

catch(PDOException $e)
{
	$connection=$e->getMessage();
	$status="unsuccessful";
	$obj=array('status'=>$status,'message'=>$connection);
    echo json_encode($obj);
	
}
?>