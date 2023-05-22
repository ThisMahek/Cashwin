<?php
//include("connect.php");
$conn= mysqli_connect('localhost','anshuwap_projects_jannat', 'jannatmatka@123','anshuwap_jannat_matka');
$name=$_POST['Firstname'];
$lname=$_POST['Lastname'];
$fname=$_POST['Fathername'];
$phone=$_POST['phonenumber'];
$password=$_POST['password'];

$sql="insert into register (Firstname,Lastname,Fathername,phonenumber,password) values('$name','$lname','$fname','$phone','$password')";
if($conn->query($sql) === TRUE)
{
    echo "success";
    
}
else
{
    echo "failed";
}


header("location:dashboard.php");


?>