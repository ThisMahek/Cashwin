<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function send_sms($mobilenumber,$textmessage){
    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('Sms_model');

    // Call a function of the model
    $sms = $CI->Sms_model->send_sms($mobilenumber,$textmessage);
    return true;
}
?>