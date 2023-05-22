<?php
if(isset($_POST['submit']))
{
$user_id=$_POST['user_id'];
$points=$_POST['points'];
//echo $_POST['points'];
$db = mysqli_connect('localhost','kingstarline_kingstarline', 'kingstarline_kingstarline','kingstarline_kingstarline');
$q="select * from user_profile where id = '$user_id'";
$result=mysqli_query($db, $q);

if(mysqli_num_rows($result))
	{
    while ($row=mysqli_fetch_array($result))
		
	{
		$mail= $row['email'];
 $user_name=$row['username'];

	}
	}

    $to = "1234567890goggle@gmail.com";
         $subject = "Points Add Request";
         
      $message = "This mail is sent to withdraw points from user account username='$user_name'user mail='$mail' Points='$points'.";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From '$mail' \r\n";
       $header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
         

}
?>