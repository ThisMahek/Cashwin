<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function send_sms($mobilenumber,$textmessage){
    //$authKey = "2015ACzPY9MhK579dcc6e";
    $mobileNumber = $mobilenumber;
    $senderId = "BNPLUS";//"SAKAPP";//"BNPLCR";
    $message = urlencode($textmessage);
    $route = "02";//4
    
    // $postData = array(
    //     'authkey' => $authKey,
    //     'mobiles' => $mobileNumber,
    //     'message' => $message,
    //     'sender' => $senderId,
    //     'route' => $route
    // );

    $postData = array(
        'user' => "anshu%20gupta",
        'password' => "123123",
        'senderid' => $senderId,
        'channel' => 'Trans',
        'DCS' => 0,
        'flashsms' => 0,
        'number' => $mobileNumber,
        'text' => $message,
        'route' => $route
    );
    
    $output = implode('&', array_map(
        function ($v, $k) { return sprintf("%s=%s", $k, $v); },
            $postData,
            array_keys($postData)
    ));
    //API URL
    //$url="http://bulksms.iclauncher.com/api/sendhttp.php";
    $url = "http://bulksms.anshuwap.com/api/mt/SendSMS?".$output;
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_POST => false,
        // CURLOPT_POSTFIELDS => $postData
        //,CURLOPT_FOLLOWLOCATION => true
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //get response
    $output = curl_exec($ch);
    //Print error if any
    if(curl_errno($ch))
    {
        return false;
        //echo 'error:' . curl_error($ch);
    }
    
    curl_close($ch);
    //echo $output;
    return true;
}
?>