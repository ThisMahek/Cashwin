<?php
try{
$dbh= new PDO('mysql:host=localhost;dbname=kingstarline_kingstarline;charset=utf8','kingstarline_kingstarline','kingstarline_kingstarline');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$email=$_POST["email"];
$mid=$_POST["mpin"];
$stmt=$dbh->query("SELECT mid FROM user_profile where email='$email'");
$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
if($results[0]["mid"]==$mid){
$obj=array('status'=>"success",'ans'=>"matched");
echo json_encode($obj);
}
    else{
        $obj=array('status'=>"unsuccessful",'ans'=>"not matched");
echo json_encode($obj);
    }
}
catch(PDOException $e)
{
	$connection=$e->getMessage();
	$status="unsuccessful";
	$obj=array('status'=>$status,'ans'=>$connection);
    echo json_encode($obj);
	
}
?>