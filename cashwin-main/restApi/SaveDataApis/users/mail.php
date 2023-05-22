<?php
$to = "1234567890goggle@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" ;


mail($to,$subject,$txt,$headers);
?>