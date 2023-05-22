<?php 
    $conn= mysqli_connect('localhost','anshuwap_projects_jannat', 'jannatmatka@123','anshuwap_jannat_matka');
	$mid  = $_POST['mid'];

	$q="select * from user_profile where mid='$mid'";
	$result = mysqli_query($conn,$q);
	//header("location:usersdata.php");
	
	if(mysqli_num_rows($result)==1)
	{
	    $row=mysqli_fetch_assoc($result);
	    if(($row['mid']===$mid) && ($row['login_status']==0)) {
	        $q1="update user_profile set login_status='1' where email='$email'";
	        mysqli_query($conn,$q1);
	        echo json_encode($row);
	    }
	}
	
        // while($row=mysqli_fetch_assoc($result,MYSQLI_BOTH)) {
        //     echo json_encode($row);
        //     //  echo $row['name'];
            //  echo $row['username'];
            //  echo $row['mobileno'];
            //  echo $row['email'];
            //  echo $row['address'];
            //  echo $row['city'];
            //  echo $row['pincode'];
            //  echo $row['password'];
            //  echo $row['accountno'];
            //  echo $row['bank_name'];
            //  echo $row['ifsc_code'];
            //  echo $row['account_holder_name'];
            //  echo $row['paytm_no'];
            //  echo $row['tez_no'];
            //  echo $row['phonepay_no'];
        //}
        
?>