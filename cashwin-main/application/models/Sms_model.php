<?php
/**
 * Sms Model
 */
class Sms_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    public function send_msg($mob, $msg)
    {
        $message = urlencode($msg);
        //$apikey = "5c519eae24213";
        $pass = "789789";
        $user = "anshu%20gupta"; //"myjewelstuff";
        $senderid = "MALSMA";
        //$url = "https://alerts.colordigitalsolutions.com/api/push.json?apikey={$apikey}&route=videocon&sender={$senderid}&mobileno={$mob}&text={$message}";
        $url = "http://bulksms.anshuwap.com/api/mt/SendSMS?user=$user&password=$pass&senderid=$senderid&channel=Trans&DCS=0&flashsms=0&number=$mob&text=$message&route=02";

        // Initialize a CURL session. 
        $ch = curl_init();

        // Return Page contents. 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //grab URL and pass it to the variable. 
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        //$f = file_get_contents($url);
        if (!$result)
            return 0;
        else
            return 1;
    }

    public function send_sms($mob, $msg)
    {
        $status1 = self::send_msg($mob, $msg);
        $data = array(
            "mobile" => $mob,
            "message" => $msg
            //"time"      => date("Y-m-d H:i:s")
        );
        // echo $_SESSION['mob']=$mob;
        return $this->db->insert('message', $data);
    }
}