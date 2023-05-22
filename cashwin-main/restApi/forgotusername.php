<?php
$dbh= new PDO('mysql:host=localhost;dbname=kingstarline_kingstarline;charset=utf8','kingstarline_kingstarline','kingstarline_kingstarline');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$email=$_POST["email"];
$stmt=$dbh->query("select name,username from user_profile where email='$email'");
$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
$name=$results[0]["name"];
$username=$results[0]["username"];

require("PHPMailer-master/PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/PHPMailer-master/src/Exception.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(true);
    $mail->SMTPDebug = 0; 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->Username = base64_decode("amhzYmlldEBnbWFpbC5jb20=");
    $mail->Password = base64_decode("TXlOZXdQYXNzQDEyMw==");
    $mail->SetFrom(base64_decode("amhzYmlldEBnbWFpbC5jb20="));
    $mail->Subject = "Jannat Matka Request Username";
    $mail->Body = "Hello ".$name.","."<br>"."<br>"."We received your request to reveal your username.Your username is ".$username."<br><br>"."Regards"."<br>"."Team Jannat Matka";
    $mail->AddAddress($email);

     if(!$mail->Send()) {
        $msg="Mailer Error: " . $mail->ErrorInfo;
        
     } else {
        $msg= "Message has been sent";
     }
echo json_encode(array("status" => "success", "message" => $msg));

?>