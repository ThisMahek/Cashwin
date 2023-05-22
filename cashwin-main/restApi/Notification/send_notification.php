<?php
require "init.php";
$title=$_POST['title'];
$message=$_POST['message'];
$path_to_fcm="https://fcm.googleapis.com/fcm/send";
$server_key="AAAAEGgM-34:APA91bE9JbSlpQ-wimJfBd9FNUdjQ_nkT_UcJXK-L374QT5YPvj8VIt5pr-kN3w9VQi0ZJ4fEkmaG1VSM5Tb39JbgeZDxjqoq3YenDgYoZsdHrc_BmbBaNJgUaXt97ZlV32vjF81g1r7";
$sql="select fcm_token from fcm_info";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_row($result);
$key=$row[0];
// if($key!==null)
// echo $key;
// else
// echo "key is empty";
$headers= array(
    'Authorization:key'.$server_key,
    'Content-Type:application/json'
    );
    
$fields=array('to'=>$key,
      'notification'=>array('title'=>$title,'body'=>$message));
      
      $payload=json_encode($fields);
      
      echo $payload;
      
$curl_session=curl_init();
curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
curl_setopt($curl_session, CURLOPT_POST, true);
curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

$result12=curl_exec($curl_session);
curl_close($curl_session);

mysqli_close($con);
      

?>
