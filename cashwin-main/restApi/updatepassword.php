<?php
$dbh= new PDO('mysql:host=localhost;dbname=kingstarline_kingstarline;charset=utf8','kingstarline_kingstarline','kingstarline_kingstarline');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
if(isset($_POST["submit"])){
$id=$_GET["id"];
$password=$_POST["pass"];
$cpassword=$_POST["npass"];
if($password==$cpassword){


$stmt=$dbh->query("select email,expirytime,status from forgotpassword where passkey='$id'");
$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
$time=time();
$email=$results[0]["email"];
if(($results[0]["expirytime"]>=$time) && ($results[0]["status"]==1)){
$q1="update user_profile set password='$password' where email='$email'";   
$q2="update forgotpassword set status='0' where email='$email' and passkey='$id'"; 
if($dbh->exec($q1) && $dbh->exec($q2)){
  echo "<script>alert('Password updated successfully');</script>";  
}
else{
    echo "<script>console.log('Error in updating password');</script>";  
}
}
else{
    echo "<script>alert('Password cannot be updated.The link has expired!!');</script>";  
}
}
else{
    echo "<script>alert('Password and Confirm password did not match');</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Update Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
<div class="formtotal" align="center">  

<form  method="POST" action="" >
      <h3 style="margin-top:2%;"> RESET PASSWORD </h3>
      
      <input placeholder="NEW PASSWORD"  type="password" name="pass" style="margin-top:1%;border-radius:10%;padding:0.5%;" required><br>
      <input placeholder="CONFIRM PASSWORD"  type="password" style="margin-top:1%;border-radius:10%;padding:0.5%;" name="npass" required><br>
      <button type="submit" class="button button-block" name="submit" style="margin-top:1%;border-radius:15%;border:1px solid black;background-color:black;color:white;padding:0.5%;">Update Password</button><br>
</form>
</div>
</body>
</html>