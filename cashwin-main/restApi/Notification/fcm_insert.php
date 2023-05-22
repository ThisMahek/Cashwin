<?php
require "init.php";
$fcm_token=$_POST['fcm_token'];
$sql="insert into fcm_info values('".$fcm_token."')";
mysqli_query($con,$sql);
// if(mysqli_affected_rows($con)>0)
// echo "done";
// else
// echo "not done";
mysqli_close($con);

?>