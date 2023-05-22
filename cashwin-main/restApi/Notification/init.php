<?php
$host="localhost";
$user_name="anshuwap_projects_jannat";
$password="jannatmatka@123";
$db_name="anshuwap_jannat_matka";

$con=mysqli_connect($host,$user_name,$password,$db_name);
if($con)
echo "Connection Successfull...";
else
echo "Connection failed...";


?>