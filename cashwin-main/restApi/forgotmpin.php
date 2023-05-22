<?php
$dbh= new PDO('mysql:host=localhost;dbname=kingstarline_kingstarline;charset=utf8','kingstarline_kingstarline','kingstarline_kingstarline');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$email=$_POST["email"];

$stmt1=$dbh->prepare("select * from user_profile where email='$email'");
$stmt1->execute();
$results=$stmt1->rowCount();

if($results>0)
{
$stmt=$dbh->query("select name from user_profile where email='$email'");
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$name=$result[0]["name"];
function getName() { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
    $n=16;
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 
$key=getName();
$t=strtotime("+15 minutes");
$url="https://jannatonline.in/restApi/updatempin.php?id=".$key;

// require("PHPMailer-master/PHPMailer-master/src/PHPMailer.php");
// require("PHPMailer-master/PHPMailer-master/src/SMTP.php");
// require("PHPMailer-master/PHPMailer-master/src/Exception.php");

//     $mail = new PHPMailer\PHPMailer\PHPMailer();
//     $mail->IsSMTP(true);

//     $mail->SMTPDebug = 2; 
//     $mail->SMTPAuth = true; 
//     $mail->SMTPSecure = 'tls'; 
//     $mail->Host = "smtp.gmail.com";
//     $mail->Port = 587; 
//     $mail->IsHTML(true);
//     $mail->Username = base64_decode("amhzYmlldEBnbWFpbC5jb20=");
//     $mail->Password = base64_decode("TXlOZXdQYXNzQDEyMw==");
//     $mail->SetFrom(base64_decode("amhzYmlldEBnbWFpbC5jb20="));
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: Jannat Online<admin@jannatonline.in>' . "\r\n";

    $subject = "Jannat Matka Password Reset";
    $body = "Hello ".$name.","."<br>"."<br>"."We received your request to reset your MPin.Kindly go this link ".$url." to change your M Pin.Kindly note that the link will be active only for 15 minutes and can be used only once to reset the M Pin."."<br><br>"."Regards"."<br>"."Team Jannat Matka";
    
    mail($email, $subject, $body, $headers);
    
    $q="INSERT into forgotmpin(email,passkey,expirytime,status) VALUES ('$email', '$key', '$t','1')";
    
    $stmt2 = $dbh->prepare($q);
    if($stmt2->execute())
      $msg= "Message has been sent";

    echo json_encode(array("status" => "success", "message" => $msg));
}
else
{
     $msg= "Email is not registered";
     echo json_encode(array("status" => "unsuccessful", "message" => $msg));
}



?>