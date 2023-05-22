<?php 
    $conn= mysqli_connect('localhost','kingstarline_kingstarline', 'kingstarline_kingstarline','kingstarline_kingstarline');
	$email  = $_POST['email'];
	$pass=$_POST['passwrod'];
	$q="select * from user_profile where email='$email'";
	$result = mysqli_query($conn,$q);
	//header("location:usersdata.php");
	
	if(mysqli_num_rows($result)==1)
	{
	    $row=mysqli_fetch_assoc($result);
	    $status="success";
	    
	}
	else
	{
	    $status="unsuccessfull";
	    $row=" not exist...";
	    
	}
	
	  $obj=array("status"=>$status, "data"=>$row);
    echo json_encode($obj);
	   // echo json_encode($row);
        
        
?>