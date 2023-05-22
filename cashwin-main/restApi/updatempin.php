<?php
$dbh= new PDO('mysql:host=localhost;dbname=kingstarline_kingstarline;charset=utf8','kingstarline_kingstarline','kingstarline_kingstarline');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
if(isset($_POST["submit"])){
$id=$_GET["id"];
$mpin=$_POST["mpin"];
$cmpin=$_POST["cmpin"];
if($password==$cpassword){


$stmt=$dbh->query("select email,expirytime,status from forgotmpin where passkey='$id'");
$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
$time=time();
$email=$results[0]["email"];
if(($results[0]["expirytime"]>=$time) && ($results[0]["status"]==1)){
$q1="update user_profile set mid='$password' where email='$email'";   
$q2="update forgotmpin set status='0' where email='$email' and passkey='$id'"; 
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
  <title>Update MPin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
<div class="formtotal" align="center">  

<form  method="POST" action="" >
      <h3 style="margin-top:2%;"> RESET MPIN</h3>
      
      <input placeholder="NEW MPin"  type="text" name="mpin" style="margin-top:1%;border-radius:10%;padding:0.5%;" required><br>
      <input placeholder="CONFIRM MPin"  type="text" style="margin-top:1%;border-radius:10%;padding:0.5%;" name="cmpin" required><br>
      <button type="submit" class="button button-block" name="submit" style="margin-top:1%;border-radius:15%;border:1px solid black;background-color:black;color:white;padding:0.5%;">Update MPin</button><br>
</form>
</div>
</body>
</html>