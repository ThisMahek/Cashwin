<?php
class Api extends CI_Controller
{
    public $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'cashwinanshuwap_db', 'cashwinanshuwap_db', 'cashwinanshuwap_db') or die("Error in connection.");
        parent::__construct();
        $this->load->database();
        $this->load->helper('sms_helper');
        $api_log = true;
        $logs_data = array("uri" => $_SERVER['REQUEST_URI'], "method" => $_SERVER['REQUEST_METHOD'], "params" => json_encode($_REQUEST), "ip_address" => $_SERVER['REMOTE_ADDR'], "time" => date('Y-m-d H:i:s'));
        if ($api_log)
            $this->db->insert("logs", $logs_data);
    }
    public function test_notice()
    {
        echo send_notice("", "Title", "message");
    }

    public function getIndex()
    {
        // $mobile='8081031624';
        // $otp='123546';
        //  send_sms($mobile,$otp);
        $data = array();
        $res = $this->db->query("select * from app_setting");
        echo json_encode($res->result());

    }
    public function getMobileData()
    {
        // $mobile='8081031624';
        // $otp='123546';
        //  send_sms($mobile,$otp);
        $data = array();
        $res = $this->db->query("select * from `site_config`");
        echo json_encode($res->result());

    }

    function request_points()
    {
        $this->load->model('Administrator_Model');
        $upi_status = $this->Administrator_Model->app_setting()->upi_status;
        $user_id = $_POST['user_id'];
        $points = $_POST['points'];
        $request_status = $_POST['request_status'];
        $txn_id = $_POST['txn_id'];
        $type = $_POST['type']; //wallet
        $wallet = $_POST['wallet'];
        //  if($upi_status==1)
        //     $request_status="approved";
        //Auto approved for UPI payments.

        if ($_POST['upi_name'] == 'PHONE_PE') {
            $request_status = 'pending';
        } else {
            $request_status = $this->input->post('request_status');
        }


        $q = "insert into tblRequest (request_points,user_id,request_status,type,txn_id) values('$points', '$user_id', '$request_status','$type','$txn_id');";
        if ($request_status != 'pending') {
            $total = $wallet + $points;
            $u_otp = "update tblwallet set wallet_points='$total' where user_id='$user_id'";
            $this->db->query($u_otp);
        }

        $dd = $this->db->query($q);

        if ($dd === TRUE) {
            $status = "success";

            $dt = array("status" => $status);
            echo json_encode($dt);
        } else {
            $status = "failed";
            $dt = array("status" => $status);
            echo json_encode($dt);
        }
    }

    public function get_sliders()
    {
        $data = array();
        $q = $this->db->query("SELECT * FROM `sliders_img`");
        $q1 = $this->db->query("select starline_img from app_setting");
        $row = $q1->row();

        $status = "success";
        $data['sliders'] = $q->result();
        $data['starline_img'] = $row->starline_img;

        $obj = array("status" => $status, "data" => $data);
        echo json_encode($obj);
    }

    public function get_notifications()
    {
        $data = array();
        $q = $this->db->query("SELECT * FROM `tblNotification` ORDER BY `tblNotification`.`time` DESC");
        if ($q->num_rows() > 0) {
            $data['responce'] = true;
            $data['data'] = $q->result();
        } else {
            $data['responce'] = false;
            $data['error'] = "No Notification Available";
        }
        echo json_encode($data);


    }

    public function sign_up()
    {
        $data = array();
        $_POST = $_REQUEST;
        $this->load->library('form_validation');
        /* add registers table validation */
        $this->form_validation->set_rules('key', 'KEY', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["error"] = strip_tags($this->form_validation->error_string());
        } else {
            $key = $this->input->post("key");
            // $key=5;
            $date = date('d/m/y');

            if ($key == 1) {
                $q = $this->db->query("select * from user_profile where mobileno='" . $this->input->post('mobile') . "' ");
                if ($q->num_rows() > 0) {
                    $data["responce"] = false;
                    $data["error"] = "Mobile Number Already Registered";
                } else {


                    $this->db->insert("user_profile", array(
                        "username" => $this->input->post("username"),
                        "name" => $this->input->post("name"),
                        "mobileno" => $this->input->post("mobile"),
                        "password" => $this->input->post("password"),
                        "login_status" => 0,
                        "mid" => $this->input->post("mpin")
                    )
                    );
                    $user_id = $this->db->insert_id();
                    $this->db->insert("tblwallet", array(
                        "user_id" => $user_id,
                        "wallet_points" => 0
                    )
                    );
                    $data["responce"] = true;
                    $data["message"] = "User Register Sucessfully..";

                }

            } else if ($key == 2) {
                $this->load->model("common_model");
                $q = $this->common_model->data_update("user_profile", array(
                    "address" => $this->input->post("address"),
                    "city" => $this->input->post("city"),
                    "pincode" => $this->input->post("pin")
                ), array("id" => $this->input->post("user_id")));
                if ($q) {
                    $data["responce"] = true;
                    $data["message"] = "Address Details Updated successfully..";
                } else {
                    $data["responce"] = false;
                    $data["message"] = "Something went wrong";
                }

            } else if ($key == 3) {
                $this->load->model("common_model");
                $q = $this->common_model->data_update("user_profile", array(
                    "accountno" => $this->input->post("accountno"),
                    "bank_name" => $this->input->post("bankname"),
                    "ifsc_code" => $this->input->post("ifsc"),
                    "account_holder_name" => $this->input->post("accountholder")
                ), array("id" => $this->input->post("user_id")));
                if ($q) {
                    $data["responce"] = true;
                    $data["message"] = "Bank Details Updated successfully..";
                } else {
                    $data["responce"] = false;
                    $data["message"] = "Something went wrong";
                }

            } else if ($key == 4) {
                $this->load->model("common_model");
                $q = $this->common_model->data_update("user_profile", array(
                    "tez_no" => $this->input->post("tez"),
                    "paytm_no" => $this->input->post("paytm"),
                    "phonepay_no" => $this->input->post("phonepay")
                ), array("id" => $this->input->post("user_id")));
                if ($q) {
                    $data["responce"] = true;
                    $data["message"] = "Payment Details Updated successfully..";
                } else {
                    $data["responce"] = false;
                    $data["message"] = "Something went wrong";
                }

            } else if ($key == 5) {
                $this->load->model("common_model");
                $q = $this->common_model->data_update("user_profile", array(
                    "email" => $this->input->post("email"),
                    "dob" => $this->input->post("dob")
                ), array("id" => $this->input->post("user_id")));
                if ($q) {
                    $data["responce"] = true;
                    $data["message"] = "User Details Updated successfully..";
                } else {
                    $data["responce"] = false;
                    $data["message"] = array("email" => $this->input->post("email"), "dob" => $this->input->post("dob"), "id" => $this->input->post("user_id"));
                }
            }

        }
        echo json_encode($data);

    }

    public function getMatkas()
    {
        $curr_date = date('Y-m-d');
        $curr_day = date('w');
        $required_time = date('Y-m-d 00:30:00', strtotime(date('Y-m-d', strtotime('-2 hour'))));
        $sql_query1 = "IFNULL(IF((matka.updated_at) >='$required_time',matka.starting_num,'***'),'***')";
        $sql_query2 = "IFNULL(IF((matka.updated_at) >='$required_time',matka.number,'**'),'**')";
        $sql_query3 = "IFNULL(IF((matka.updated_at) >='$required_time',matka.end_num,'***'),'***')";
        $this->db->select('matka.id,matka.name,matka.start_time,matka.end_time,matka.sat_start_time,matka.sat_end_time,' . $sql_query1 . ' as starting_num,' . $sql_query2 . ' as number,' . $sql_query3 . ' as end_num,matka.bid_start_time,matka.bid_end_time,matka.created_at,matka.updated_at,matka.status,matka.matka_order,matka.is_delhi_game');
        $this->db->from('matka');
        $this->db->where('matka.status', 'active')->order_by('matka_order', 'ASC');
        $q = $this->db->get()->result();
        echo json_encode($q);

    }
    public function getMatkaGames()
    {
        $data = array();
        $res = $this->db->query("select * from tblgame where is_deleted='0'");
        echo json_encode($res->result());

    }
    public function getStarline()
    {

        $q = "select * from tblStarline where s_game_time !=''";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data[$i]['id'] = $row['id'];
                $data[$i]['s_game_time'] = $row['s_game_time'];
                if (strtotime(date('Y-m-d')) == strtotime(date('Y-m-d', strtotime($row['updated_at']))))
                    $data[$i]['s_game_number'] = $row['s_game_number'];
                else
                    $data[$i]['s_game_number'] = "***";

                $i++;
            }
        } else {
            $data = "0";
        }
        echo json_encode($data);
    }

    public function get_matka_with_id()
    {

        $q = $this->db->query("select * from  matka where id='" . $this->input->post('id') . "'");
        $status = "success";
        $data = $q->row();

        $obj = array("status" => $status, "data" => $data);
        echo json_encode($obj);
    }


    function how_to_play()
    {
        $hto = "Value1 is here .....";
        $hto2 = "www.google.co.in";
        $x['data'] = $hto;
        $x['link'] = $hto2;
        $obj = array($x);
        echo json_encode($obj);
    }


    public function login()
    {
        $data = array();
        $_POST = $_REQUEST;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mobileno', 'Mobile No', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["error"] = strip_tags($this->form_validation->error_string());
        } else {
            $q = $this->db->query("select * from user_profile where (mobileno='" . $this->input->post('mobileno') . "' )  Limit 1");

            if ($q->num_rows() > 0) {
                $row = $q->row();
                $db_pass = $row->password;
                $pass = $this->input->post('password');
                if ($pass == $db_pass) {

                    if ($row->login_status == "1") {
                        $data["responce"] = false;
                        $data["error"] = 'Your account currently inactive.Please Contact Admin';
                    } else {
                        $token = $this->input->post('token');
                        $arr = array(
                            "user_ios_token" => $token
                        );
                        $this->db->where('mobileno', $this->input->post('mobileno'));
                        $this->db->update('user_profile', $arr);

                        $data["responce"] = true;
                        $user_id = $row->id;
                        $temp = array();
                        $temp['id'] = $row->id;
                        $temp['name'] = $row->name;
                        $temp['username'] = $row->username;
                        $temp['mobileno'] = $row->mobileno;
                        $temp['password'] = $row->password;
                        $temp['email'] = $row->email;
                        $temp['address'] = $row->address;
                        $temp['city'] = $row->city;
                        $temp['pincode'] = $row->pincode;
                        $temp['password'] = $row->password;
                        $temp['accountno'] = $row->accountno;
                        $temp['bank_name'] = $row->bank_name;
                        $temp['ifsc_code'] = $row->ifsc_code;
                        $temp['account_holder_name'] = $row->account_holder_name;
                        $temp['paytm_no'] = $row->paytm_no;
                        $temp['tez_no'] = $row->tez_no;
                        $temp['phonepay_no'] = $row->phonepay_no;
                        $temp['dob'] = $row->dob;
                        $temp['status'] = $row->status;

                        $qw = $this->db->query("select * FROM `tblwallet` where user_id='" . $user_id . "' Limit 1");
                        $wrow = $qw->row();
                        $temp['wallet'] = $wrow->wallet_points;
                        $data['data'] = $temp;

                    }
                } else {
                    $data["responce"] = false;
                    $data["error"] = 'Wrong Password';

                }

            } else {
                $data["responce"] = false;
                $data["error"] = 'Mobile Number does not exist';
            }
        }
        echo json_encode($data);
    }

    public function setAsLogin()
    {

        $email = $_POST['email'];
        $q1 = "update user_profile set login_status='1' where email='$email'";
        if (mysqli_query($this->conn, $q1))
            echo json_encode(array("status" => "success"));
    }

    public function setAsLogout()
    {

        $email = $_POST['email'];
        $q1 = "update user_profile set login_status='0' where email='$email'";
        if (mysqli_query($this->conn, $q1))
            echo json_encode(array("status" => "success"));
    }
    public function getNotice()
    {

        $q = $this->db->query("Select * from tblNotice");
        $status = "success";
        $data = $q->result();

        $obj = array('status' => $status, 'data' => $data);
        echo json_encode($obj);
    }

    public function getWalletAmount()
    {

        $q = $this->db->query("SELECT * FROM tblwallet where user_id='" . $this->input->post('user_id') . "' LIMIT 1");
        echo json_encode($q->result());

    }

    public function test()
    {

        $m = 21;
        $q1 = "select * from tblStarline where id = '$m'";
        $result = mysqli_query($this->conn, $q1) or die("some err");
        $row = mysqli_fetch_assoc($result);


        $st = $et = "s_game_time";
        $time = $row[$st];

        echo strtotime(date('h:i A')) . "<hr>" . time();
    }

    public function insert_data()
    {
        $status = "";
        $result = mysqli_query($this->conn, "SELECT MAX(id) as c FROM tblgamedata") or die("some err");
        if ($row = mysqli_fetch_assoc($result))
            $maxid = $row['c']++;
        $jsonArr = $_POST['data'];
        //$jsonArr='[{"points":"[10, 10, 10, 10, 10, 10, 10, 10, 10, 10]","digits":"[\"120\", \"200\", \"220\", \"230\", \"240\", \"250\", \"260\", \"270\", \"280\", \"290\"]","bettype":"[0, 0, 0, 0, 0, 0, 0, 0, 0, 0]","user_id":"6","matka_id":"29","game_date":"10\/09\/2020","game_id":"14"}]';
        // [{"points":"[10, 10, 10, 10, 10]","digits":"["1", "3", "5", "7", "9"]","bettype":"[0,0, 0,0,0]","user_id":"10","matka_id":"2","date":"07/09/2019","game_id":"1"}]
        // $jsonArr = '[{"points":"[10]","digits":"[\"00\"]","bettype":"[1]","user_id":"1","matka_id":"16","game_date":"30\/11\/2022","game_id":"jodi_digit"}]';
        if (empty($jsonArr))
            $status = "failed1";
        else {
            //[{"points":"[10, 10, 10, 10, 10]","digits":"[121-345, 3, 5, 7, 9]","bettype":"[Opening Bet, Opening Bet, Opening Bet, Opening Bet, Opening Bet]","user_id":"2","matka_id":"2","date":"15/02/2001"}]

            $json = json_decode($jsonArr);
            foreach ($json as $js):
                $ponts = $i = $e = 0;
                $dds = FALSE;
                $bettype_st = false;
                $points = json_decode($js->points);
                $digits = json_decode($js->digits);
                $bettype = json_decode($js->bettype);

                $u = $js->user_id;
                $m = $js->matka_id;
                $dx = date('d/m/Y'); //26/06/2019//$js->game_date; // Mannually added current date.
                $gm = $js->game_id;

                if ($m <= 25):
                    $q1 = "select * from matka where id = '$m'";
                    $st = (date('D') === 'Sat') ? 'sat_start_time' : ((date('D') === 'Sun') ? 'start_time' : 'bid_start_time');
                    $et = (date('D') === 'Sat') ? 'sat_end_time' : ((date('D') === 'Sun') ? 'end_time' : 'bid_end_time');
                else:
                    $q1 = "select * from tblStarline where id = '$m'";
                    $st = $et = "s_game_time";
                    $bettype_st = "open"; // Manually added for starline.
                endif;

                $dd = mysqli_query($this->conn, $q1) or die("some err1");
                if ($row1 = mysqli_fetch_assoc($dd)) {
                    // $stime = $row1[$st];
                    // $etime = $row1[$et];
                    $a_time = strtotime(date('h:i A'));
                    $time1 = ($bettype[$i] == 0) ? $row1[$st] : $row1[$et];
                    $time = date('h:i A', strtotime($time1));
                    // echo 'ghh';
                    // die;
                    if (($a_time <= strtotime($time)) || (strtotime(date('Y-m-d')) < strtotime(date('Y-m-d', strtotime($dx))))):

                        $q2 = "select * from tblwallet where user_id = '$u'";
                        $dd1 = mysqli_query($this->conn, $q2) or die("some err2");
                        $row2 = mysqli_fetch_assoc($dd1);
                        if (count($row2) > 0):

                            $wallet_amt = $row2['wallet_points'];
                            foreach ($points as $pa):
                                //  print_r('hi8');exit;
                                $p = $points[$i];
                                $wallet_amt = $wallet_amt - $p;
                                if ($wallet_amt >= 0):
                                    $ponts += $p;

                                    $d = (string) $digits[$i];
                                    if ($gm == 12):
                                        // print_r('hi18');exit;
                                        $d_arr = explode('-', $d);
                                        if (is_array($d_arr) && strlen($d_arr[1]) == 1)
                                            $bettype_st = "open";
                                        else
                                            $bettype_st = false;
                                    endif;

                                    $bt = ($bettype[$i] == 0 || $bettype_st) ? "open" : "close";

                                    $q = "insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm')";

                                    //$dd = mysqli_query($this->conn, $q) or die("some err3");
                                    $dd = $this->db->query($q);

                                    $maxid++;
                                    $qs = "insert into history (user_id,matka_id,amt,digits,bid_id,date,type,game_id) values('$u', '$m', '$p', '$d','$maxid', '$dx', 'd','$gm')";
                                    //$dds = mysqli_query($this->conn, $qs) or die("some err4");
                                    $dds = $this->db->query($qs);
                                    $i++;
                                endif;
                            endforeach;
                        endif;
                    else:
                        $status = "timeout";
                    endif;
                }
                if ($ponts > 0) {
                    if (count($row2) > 0)
                        $q = "update tblwallet set wallet_points = wallet_points-$ponts where user_id = '$u'";
                    else
                        $q = "insert into tblwallet (wallet_points, user_id) VALUES (0, '$u')";
                    // $dd = mysqli_query($this->conn, $q) or die("some err5");
                    $dd = $this->db->query($q);
                }
            endforeach;

            if (($dds === TRUE) && ($status != "timeout")) {
                $status = "success";
                $dt = array("status" => $status);
                echo json_encode($dt);
                return false;
            } elseif ($status == null) {
                $status = "failed";
            }
            // elseif($status=="timeout")
            // {
            //     $status="timeout";
            // }
        }
        $dt = array("status" => $status);
        echo json_encode($dt);
    }
    public function getMobile()
    {

        $q = "select mobile from site_config";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $data['count'] = 20;
            $data['starline'] = "https://www.binplus.in";
            $data['chart1'] = "https://serveradda.com/billing";
            $data['chart2'] = "https://www.google.com";
        } else {
            $data['mobile'] = "XXXXXXXXXXXX";
            $data['count'] = 20;
            $data['starline'] = "https://www.binplus.in";
            $data['chart1'] = "https://serveradda.com/billing";
            $data['chart2'] = "https://www.google.com";
        }

        echo json_encode($data);
    }

    public function insert_sangam_data()
    {

        $result = mysqli_query($this->conn, "SELECT MAX(id) as c FROM tblgamedata") or die("some err");
        $a_time = strtotime(date('h:i A'));
        if ($row = mysqli_fetch_assoc($result))
            $maxid = $row['c']++;
        $jsonArr = $_POST['data'];
        if (empty($jsonArr))
            $status = "failed1";
        else {
            $json = json_decode($jsonArr);
            foreach ($json as $js):
                $ponts = $i = $e = 0;
                $points = json_decode($js->points);
                $digits = json_decode($js->digits);
                $bettype = json_decode($js->bettype);

                $u = $js->user_id;
                $m = $js->matka_id;
                $dx = $js->date;
                $gm = $js->game_id;

                $q1 = "select * from matka where id = '$m'";
                $dd = mysqli_query($this->conn, $q1) or die("some err1");

                $st = (date('D') === 'Sat') ? 'sat_start_time' : ((date('D') === 'Sun') ? 'start_time' : 'bid_start_time');
                $et = (date('D') === 'Sat') ? 'sat_end_time' : ((date('D') === 'Sun') ? 'end_time' : 'bid_end_time');
                if ($row1 = mysqli_fetch_assoc($dd)) {
                    // $stime = $row1[$st];
                    // $etime = $row1[$et];
                    $time1 = ($bettype[$i] == 0) ? $row1[$st] : $row1[$et];
                    $time = date('h:i A', strtotime($time1));
                    if (($a_time <= strtotime($time)) || (strtotime(date('Y-m-d')) < strtotime($dx))):

                        $q2 = "select * from tblwallet where user_id = '$u'";
                        $dd1 = mysqli_query($this->conn, $q2) or die("some err2");
                        $row2 = mysqli_fetch_assoc($dd1);
                        if (count($row2) > 0):
                            $wallet_amt = $row2['wallet_points'];

                            foreach ($points as $pa):
                                $p = $points[$i];
                                $wallet_amt = $wallet_amt - $p;
                                if ($wallet_amt >= 0):
                                    $ponts += $p;
                                    $d = (string) $digits[$i];
                                    $bt = (string) $bettype[$i];

                                    $q = "insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm')";
                                    $dd = mysqli_query($this->conn, $q) or die("some err3");
                                    $maxid++;
                                    $qs = "insert into history (user_id,matka_id,amt,digits,bid_id,date,type,game_id) values('$u', '$m', '$p', '$d','$maxid', $dx, 'd','$gm')";
                                    $dds = mysqli_query($this->conn, $qs) or die("some err4");
                                    $i++;
                                endif;
                            endforeach;
                        endif;
                    else:
                        $status = "timeout";
                    endif;
                }
                if ($ponts > 0) {
                    if (count($row2) > 0)
                        $q = "update tblwallet set wallet_points = wallet_points-$ponts where user_id = '$u'";
                    else
                        $q = "insert into tblwallet (wallet_points, user_id) VALUES (0, '$u')";
                    $dd = mysqli_query($this->conn, $q) or die("some err5");
                }
            endforeach;

            if (($dds === TRUE) && ($status != "timeout")) {
                $status = "success";
                $dt = array("status" => $status);
                echo json_encode($dt);
                return false;
            } elseif ($status == null) {
                $status = "failed";
            } elseif ($status == "timeout") {
                $status = "timeout";
            }
        }
        $dt = array("status" => $status);
        echo json_encode($dt);
        //     $q1="SELECT MAX(id) FROM tblgamedata";
        //     $d2 = $this->conn->query($q1);
        //     //echo $d2;
        //     if($row=mysqli_fetch_array($d2,MYSQLI_BOTH)) {
        //         $maxid=  $row[0];
        //     }
        //     $maxid=$maxid++;
        //     //$jsonArr = '[{"points":"[10, 10, 10, 10, 10]","digits":"[266-366, 266-366, 466-566, 666-766, 866-966]","bettype":"[0, 0, 0, 0, 1]","user_id":"2","matka_id":"2","date":"15/02/2001"}]';
        //     // $jsonArr = '[{"points":"[10, 10, 10, 10, 10]","digits":"[111, 266, 466, 666, 866]","bettype":"[112, 262, 462, 662, 8622]","user_id":"2","matka_id":"2","date":"15/02/2001","game_id":"2"}]';
        //     $jsonArr=$_POST['data'];
        //     if(empty( $jsonArr)) {
        //         $status="failed1";
        //     } else {
        //         //[{"points":"[10, 10, 10, 10, 10]","digits":"[121-345, 3, 5, 7, 9]","bettype":"[Opening Bet, Opening Bet, Opening Bet, Opening Bet, Opening Bet]","user_id":"2","matka_id":"2","date":"15/02/2001"}]
        //         $json = json_decode($jsonArr);
        //         //print_r($json[0]->points);
        //         foreach($json as $js):
        //             $i = $ponts = 0;
        //             $points = json_decode($js->points);
        //             $digits = json_decode($js->digits);
        //             $bettype = json_decode($js->bettype);
        //             foreach($points as $pa):
        //                 $u = $js->user_id;
        //                 $m = $js->matka_id;
        //                 $p = $points[$i];
        //                 $ponts += $points[$i];
        //                 $d = $digits[$i];
        //                 $dx = $js->date;
        //                 $bt = $bettype[$i];
        //                 $gm= $js->game_id;

        //           $q="insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm');";
        //               //$q="insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm')";
        //              $dd = $this->conn->query($q);
        //                     $px="d";
        //                     // echo $gm;
        //                     $maxid++;
        //                     $qs="insert into history (user_id,matka_id,amt,digits,bid_id,date,type,game_id) values('$u', '$m', '$p', '$d','$maxid', '$dx', '$px','$gm')";
        //                     $dds = $this->conn->query($qs);




        //                 $i++;
        //             endforeach;        
        //         endforeach;

        //           if($ponts>0)
        //             {
        //                 $id = $u;
        //                 $q1 = "select * from tblwallet where user_id = '$id'";
        //                 $dd1 = $this->conn->query($q1);
        //                 if(count($dd1)>0)
        //                     $q = "update tblwallet set wallet_points = wallet_points-'$ponts' where user_id = '$id'";
        //                 else
        //                     $q = "insert into tblwallet (wallet_points, user_id) VALUES ('-$points', '$id')";
        //                 $dd = $this->conn->query($q);
        //             }

        //         	if ($dds === TRUE) {
        //         	    $status="success";
        //                 $dt = array("status" => $status);
        //                 echo json_encode($dt);
        //                 return 1;
        //         	}
        //         	else if($status==null)
        //         	{
        //         	    $status="failed";
        //         	}
        //         // 	else
        //         //         $status = $e." bids already ".$status;
        //     }
        //      $dt = array("status" => $status);
        //      echo json_encode($dt);
    }

    public function get_history()
    {
        $data = array();
        $user_id = $this->input->post('user_id');
        $page = $this->input->post('page');
        // $user_id=3;
        $from_date = $this->input->post('from_date') ?? date('Y-m-d');
        $to_date = $this->input->post('to_date') ?? date('Y-m-d');
        // $page = 1;
        $page_limit = 10;
        $limit = "";
        if ($page != "") {
            $limit .= " limit " . (($page - 1) * $page_limit) . "," . $page_limit . " ";
        }
        $data["responce"] = true;
        $q = $this->db->query("SELECT tblgamedata.*,matka.name FROM `tblgamedata` JOIN matka ON matka.id=tblgamedata.matka_id WHERE user_id='" . $user_id . "' AND DATE(tblgamedata.time) >= '" . $from_date . "'
                                AND DATE(tblgamedata.time) <= '" . $to_date . "' ORDER BY `id` DESC $limit ");
        //  echo $this->db->last_query();die();
        $data['data'] = $q->result();

        $q1 = $this->db->query("SELECT tblgamedata.*,matka.name FROM `tblgamedata` JOIN matka ON matka.id=tblgamedata.matka_id WHERE user_id='" . $user_id . "' and DATE(tblgamedata.time) >= '" . $from_date . "' and DATE(tblgamedata.time) <= '" . $to_date . "' ORDER BY `id` DESC");
        $data['total_data'] = $q1->num_rows();
        echo json_encode($data);

    }



    public function getBidHistory()
    {

        $us_id = $_POST['us_id'];
        $matka_id = $_POST['matka_id'];

        $play_for = date('Y-m-d');
        $play_on = "";


        if ($matka_id < 14) {

            $odd_even = 'tblgamedata.id,tblgamedata.user_id,tblgamedata.matka_id,tblgamedata.points,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.digits,tblgamedata.game_id,tblgamedata.status,matka.name ';
            //$odd_even = 'tblodd_even.id,tblodd_even.user_id,tblodd_even.matka_id,tblodd_even.points,tblodd_even.bet_type,tblodd_even.date,tblodd_even.time,tblodd_even.digits,matka.name';
            $q = "select " . $odd_even . " from  tblgamedata JOIN matka ON matka.id=tblgamedata.matka_id where tblgamedata.user_id=$us_id and tblgamedata.matka_id=$matka_id ORDER BY time DESC";
            $result = mysqli_query($this->conn, $q);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $x['play_for'] = $row['time'];
                    $x['play_on'] = $row['time'];
                    $newDate = date("l", strtotime($x['play_on']));
                    $x['day'] = $newDate;
                    $r = array_merge($row, $x);
                    $data[] = $r;
                }
            } else {
                $data[] = null;
            }
        } else {
            $d = "select tblgamedata.id,tblgamedata.user_id,tblgamedata.matka_id,tblgamedata.points,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.digits,tblgamedata.game_id,tblgamedata.status,tblStarline.s_game_time from tblgamedata,tblStarline where  tblgamedata.user_id=$us_id AND tblgamedata.matka_id=tblStarline.id AND matka_id>'15' ORDER BY time DESC";
            $result1 = mysqli_query($this->conn, $d);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $x['play_for'] = $row1['time'];
                    $x['play_on'] = $row1['time'];
                    $newDate = date("l", strtotime($x['play_on']));
                    $x['day'] = $newDate;
                    $r = array_merge($row1, $x);
                    $data[] = $r;
                }
            } else {
                $data[] = null;
            }
        }


        echo json_encode($data);
    }

    public function insert_withdraw_request()
    {
        $user_id = $_POST['user_id'];
        $points = $_POST['points'];
        $date = $_POST['date'];
        $request_status = $_POST['request_status'];

        $d = "select * from tblWithdrawRequest where user_id=$user_id";
        $result1 = mysqli_query($this->conn, $d);

        //2019-07-25 12:33:55

        if ($result1->num_rows > 0) {


            while ($row = $result1->fetch_assoc()) {
                $newDate = date("d-m-Y", strtotime($row['time']));

                $row1[] = $newDate;
            }


            if (in_array($date, $row1)) {
                $status = "failed";
                $data = "Daily Withdraw limit Exceeded";
            } else {
                $q = "insert into tblWithdrawRequest (withdraw_points,user_id,withdraw_status) values('$points', '$user_id', '$request_status')";
                // echo $q;    
                $dd = $this->conn->query($q);
                if ($dd === TRUE) {
                    $status = "success";
                    $data = "Request Successfull..";
                } else {
                    $status = "failed";
                    $data = "Something Went Wrong";
                }

            }

        } else {
            $q = "insert into tblWithdrawRequest (withdraw_points,user_id,withdraw_status) values('$points', '$user_id', '$request_status')";
            // echo $q;    
            $dd = $this->conn->query($q);
            if ($dd === TRUE) {
                $status = "success";
                $data = "Request Successfull..";
            } else {
                $status = "failed";
                $data = "Something Went Wrong";
            }

        }


        //	echo json_encode($row1);



        $obj = array('status' => $status, 'message' => $data);
        echo json_encode($obj);

    }

    public function generate_otp()
    {

        $mobile = $this->input->post('mobile');
        $otp = $this->input->post('otp');

        //   $mobile='8081031624';
        //   $otp='132465';

        $q = $this->db->query("select * from user_profile where (mobileno='" . $mobile . "') Limit 1");

        if ($q->num_rows() > 0) {
            //   send_sms($mobile,$otp);

            $status = "success";
            $msg = "Your Chirag Games One Time Password (OTP) is {$otp}. Don't share it with anyone. We don't call/email you to verify OTP. OTP is valid for 15 mins.";

            @send_sms($mobile, $msg);
            $data = "Code sent to your registered mobile number";

        } else {
            $status = "failed";
            $data = "Mobile number not registered.";
        }

        $obj = array('status' => $status, 'message' => $data);
        echo json_encode($obj);
    }

    public function mobile_verification()
    {

        $mobile = $this->input->post('mobile');
        $otp = $this->input->post('otp');
        $q = $this->db->query("select * from user_profile where (mobileno='" . $mobile . "') Limit 1");
        if ($q->num_rows() > 0) {
            $status = "failed";
            $data = "Mobile number already registered \n try another number";
        } else {
            $msg = "Your Chirag Games One Time Password (OTP) is {$otp}. Don't share it with anyone. We don't call/email you to verify OTP. OTP is valid for 15 mins.";

            @send_sms($mobile, $msg);

            $status = "success";
            $data = "verification";
        }

        $obj = array('status' => $status, 'message' => $data);
        echo json_encode($obj);
    }

    public function mpin_verification()
    {
        // $this->input->post('mobile')
        // $this->input->post('mpin')
        $mobile = $this->input->post('mobile');
        $mpin = $this->input->post('mpin');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('mpin', 'Mpin', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["message"] = strip_tags($this->form_validation->error_string());
        } else {
            $q = $this->db->query("select * from user_profile where mobileno='" . $mobile . "' ")->row();
            if (count($q) > 0) {
                if ($mpin == $q->mid) {
                    $data["responce"] = true;
                    $data["message"] = "success";
                } else {
                    $data["responce"] = false;
                    $data["message"] = "Wrong mpin entered.";
                }

            } else {
                $data["responce"] = false;
                $data["message"] = "User id does not exist";
            }
        }

        echo json_encode($data);
    }

    public function forgot_mpin()
    {
        // $this->input->post('mobile')
        // $this->input->post('mpin')
        $mobile = $this->input->post('mobile');
        $mpin = $this->input->post('mpin');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('mpin', 'Mpin', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["message"] = strip_tags($this->form_validation->error_string());
        } else {
            $q = $this->db->query("select * from user_profile where mobileno='" . $mobile . "' ")->row();
            if (count($q) > 0) {
                $arr = array("mid" => $mpin);
                $query = $this->db->where('mobileno', $mobile)->update('user_profile', $arr);
                if ($query) {
                    $data["responce"] = true;
                    $data["message"] = "success";
                } else {
                    $data["responce"] = false;
                    $data["message"] = "failed";
                }
            } else {
                $data["responce"] = false;
                $data["message"] = "User does not exist";
            }
        }

        echo json_encode($data);
    }

    public function forgot_password()
    {

        $this->load->model("common_model");
        $dd = $this->common_model->data_update("user_profile", array(
            "password" => $this->input->post("password")
        ), array("mobileno" => $this->input->post("mobile")));
        if ($dd) {
            $status = "success";
            $data = "Password updated successfully.";
        } else {
            $status = "failed";
            $data = "Something went wrong";
        }

        $obj = array('status' => $status, 'message' => $data);
        echo json_encode($obj);


    }


    public function create_mpin()
    {

        $user_id = $_POST['user_id'];
        $mpin = $_POST['mpin'];

        $q = "update user_profile set mid='" . $mpin . "' where id='" . $user_id . "'";
        $dd = $this->conn->query($q);
        if ($dd === TRUE) {
            $status = "success";
            $data = "MPIN gnerated successfully..";
        } else {
            $status = "failed";
            $data = "Something went wrong";
        }

        $obj = array('status' => $status, 'message' => $data);
        echo json_encode($obj);

    }


    public function generate_login_otp()
    {

        $mobile = $_POST['mobile'];
        $pass = $_POST['password'];
        $otp = $_POST['otp'];
        $q = "select * from user_profile where mobileno='$mobile'";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db_pass = $row['password'];
            if ($pass == $db_pass) {
                $status = "success";
                $msg = "Your login OTP is " . $otp . " for SM7 Online";
                // send_sms($mobile,$msg);
                $id = $row['id'];
                $u_otp = "update user_profile set otp='$otp' where id='$id'";
                $dd = $this->conn->query($u_otp);
                if ($dd === TRUE) {
                    $status = "success";
                    $data = "OTP sent to your registered mobile number";
                } else {
                    $status = "failed";
                    $data = "Something went wrong";
                }
            } else {
                $status = "failed";
                $data = "Password is incorrect";
            }

        } else {
            $status = "failed";
            $data = "Mobile Number not registered.";
        }

        $obj = array('status' => $status, 'message' => $data);
        echo json_encode($obj);

    }


    public function get_starline()
    {
        $q = "select * from tblStarline where s_game_time !=''";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data[$i]['id'] = $row['id'];
                $data[$i]['s_game_time'] = $row['s_game_time'];
                $data[$i]['s_game_end_time'] = $row['s_game_end_time'];

                if (strtotime(date('Y-m-d')) == strtotime(date('Y-m-d', strtotime($row['updated_at']))))
                    $data[$i]['s_game_number'] = $row['s_game_number'];
                else
                    $data[$i]['s_game_number'] = "***";

                $i++;
            }
        } else {
            $data = "0";
        }
        echo json_encode($data);
    }


    public function getSpMotor()
    {
        $s = $_POST["arr"];
        $a = str_split($s);
        $arr = implode($a, ",");

        $numArray = explode(",", $arr);
        $arr = array_map('intval', $numArray);
        //print_r( $arr);
        $data = array(
            array(137, 128, 146, 236, 245, 290),
            array(380, 470, 489, 560, 678, 579),
            //array(119,155,227,335,344,399),
            //array(588,669,777,100),
            array(129, 138, 147, 156, 237, 246),
            array(345, 390, 480, 570, 589, 679),
            //array(110,228,255,336,499,660),
            //array(688,778,200,444),
            array(120, 139, 148, 157, 238, 247),
            array(256, 346, 490, 580, 670, 689),
            //array(166,229,337,355,445,599),
            //array(779,788,300,111),
            array(130, 149, 158, 167, 239, 248),
            array(257, 347, 356, 590, 680, 789),
            //array(112,220,266,338,446,455),
            //array(699,770,400,888),
            array(140, 159, 168, 230, 249, 258),
            array(267, 348, 357, 456, 690, 780),
            //array(113,122,177,339,366,447),
            //array(799,889,500,555),
            array(123, 150, 169, 178, 240, 259),
            array(268, 349, 358, 367, 457, 790),
            //array(114,277,330,448,466,556),
            //array(880,899,600,222),
            array(124, 160, 179, 250, 269, 278),
            array(340, 359, 368, 458, 467, 890),
            //array(115,133,188,223,377,449),
            //array(557,566,700,999),
            array(125, 134, 170, 189, 260, 279),
            array(350, 369, 378, 459, 468, 567),
            //array(116,224,233,288,440,477),
            //array(558,990,800,666),
            array(126, 135, 180, 234, 270, 289),
            array(360, 379, 450, 469, 478, 568),
            //array(117,144,199,225,388,559),
            //array(577,667,900,333),
            array(127, 136, 145, 190, 235, 280),
            array(370, 389, 460, 479, 569, 578),
            //array(118,226,244,299,334,488),
            //array(668,677,000,550)
        );
        $a = 0;
        $b = 0;
        $a = 0;
        $k = 0;
        $t = 0;
        $m = array();
        $final = array();

        for ($i = 0; $i < count($data); $i++) {
            for ($j = 0; $j < count($data[$i]); $j++) {
                $k = 0;
                $b = 0;
                $num = $data[$i][$j];
                while ($num != 0) {
                    $d = $num % 10;
                    $b++;
                    if ($b < 4) {
                        if (!(in_array($d, $arr, false))) {
                            $k = 1;
                            break;
                        }
                    }
                    $num = (int) $num / 10;
                }
                if ($k == 0)
                    $m[$a++] = $data[$i][$j];

                //              echo $m;

                //print_r($m);

            }
        }
        for ($i = 0; $i < count($m); $i++) {
            $b = 0;
            $c = 0;
            $num = $m[$i];
            while ($num != 0) {
                $d = $num % 10;
                $arr2[$b++] = $d;
                $num = (int) $num / 10;

                //    echo $d;
            }
            //  for($j=0;$j<2;$j++){
            //      if($arr2[$j]<=$arr2[($j)+1]){
            //          $c=1;
            //          break;
            //      }
            //  }
            //  if($c==0){
            $final[$t++] = $m[$i];
            // }
        }
        echo json_encode(array("status" => "success", "data" => $final));
    }



    public function get_dpmotor()
    {
        $s = $_POST["arr"];
        $a = str_split($s);
        $arr = implode($a, ",");
        //echo $arr;
        //$arr=$_POST["arr"];
        $numArray = explode(",", $arr);
        $arr = array_map('intval', $numArray);

        $data = array(
            118,
            226,
            244,
            299,
            334,
            488,
            550,
            668,
            677,
            100,
            119,
            155,
            227,
            335,
            344,
            399,
            588,
            669,
            110,
            200,
            228,
            255,
            336,
            499,
            660,
            688,
            778,
            166,
            229,
            300,
            337,
            355,
            445,
            599,
            779,
            788,
            112,
            220,
            266,
            338,
            400,
            446,
            455,
            699,
            770,
            113,
            122,
            177,
            339,
            366,
            447,
            500,
            799,
            889,
            600,
            114,
            277,
            330,
            448,
            466,
            556,
            880,
            899,
            115,
            133,
            188,
            223,
            377,
            449,
            557,
            566,
            700,
            116,
            224,
            233,
            288,
            440,
            477,
            558,
            800,
            990,
            117,
            144,
            199,
            225,
            388,
            559,
            577,
            667,
            900
        );
        //244,334,155,335,344,255,355,445,112,455,113,122,114,115,133,223,224,233,144,225

        $a = 0;
        $b = 0;
        $a = 0;
        $k = 0;
        $t = 0;
        $m = array();
        $final = array();

        for ($i = 0; $i < count($data); $i++) {

            $k = 0;
            $b = 0;
            $num = $data[$i];
            while ($num != 0) {
                $d = $num % 10;
                $b++;
                if ($b < 4) {
                    if (!(in_array($d, $arr, false))) {

                        $k = 1;
                        break;
                    }

                }
                $num = (int) $num / 10;
            }
            if ($k == 0)
                $m[$a++] = $data[$i];

        }

        for ($i = 0; $i < count($m); $i++) {
            $b = 0;
            $c = 0;
            $num = $m[$i];
            while ($num != 0) {
                $d = $num % 10;
                $arr2[$b++] = $d;
                $num = (int) $num / 10;
            }
            for ($j = 0; $j < 2; $j++) {
                if ($arr2[$j] <= $arr2[($j) + 1]) {
                    $c = 1;
                    break;
                }
            }
            if ($c == 1) {
                $final[$t++] = $m[$i];
            }
        }


        echo json_encode(array("status" => "success", "data" => $final));
    }

    public function get_matkas()
    {

        $row_dt = "";
        $matka = array();
        $q = "select * from matka ORDER BY matka_order";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            $i = 0;
            $curr_time = strtotime(date('H:i:s'));
            while ($row = $result->fetch_assoc()) {
                if (date('D') === 'Sat') {
                    $bid_start_time = $row['sat_start_time'];
                    $bid_end_time = $row['sat_end_time'];
                }
                if (date('D') === 'Sun') {
                    $bid_start_time = $row['start_time'];
                    $bid_end_time = $row['end_time'];
                } else {
                    $bid_start_time = $row['start_time'];
                    $bid_end_time = $row['end_time'];
                }
                $type = (($curr_time >= strtotime($bid_start_time)) && ($curr_time <= strtotime($bid_end_time))) ? "live" : "old";
                $data[$i] = $row;
                $data[$i]['bid_start_time'] = $bid_start_time;
                $data[$i]['bid_end_time'] = $bid_end_time;
                $data[$i]['type'] = $type;
                $i++;
            }


        } else {
            $data = "0";
        }

        echo json_encode($data);

    }

    public function matka_with_id()
    {

        $us_id = $_POST['id'];
        $q = "select * from  matka where id=$us_id ";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status = "success";
                $data = $row;
            }
        } else {
            $status = "success";
            $data[] = "0";
        }

        $obj = array("status" => $status, "data" => $data);
        echo json_encode($obj);

    }

    public function starline_data()
    {

        $q = $this->db->query("select * from tblStarline where id='" . $this->input->post('id') . "'");

        if ($q->num_rows() > 0) {
            echo json_encode($q->row());
        } else {
            echo json_encode("0");
        }

    }


    public function add_request()
    {
        $data = array();
        $_POST = $_REQUEST;
        $this->load->library('form_validation');
        /* add registers table validation */
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
        $this->form_validation->set_rules('points', 'Points', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["error"] = strip_tags($this->form_validation->error_string());
        } else {
            $user_id = $this->input->post('user_id');
            $points = $this->input->post('points');
            $request_status = $this->input->post('request_status');

            $type = $this->input->post('type');
            $method = $this->input->post('method');
            $method_number = $this->input->post('method_number');
            $method_msg = "";
            if ($method != "" || $method_number != "") {
                $method_msg = $method . '<br>' . $method_number;
            }

            $q = $this->db->insert("tblRequest", array(
                "user_id" => $user_id,
                "request_points" => $points,
                "request_status" => $request_status,
                "type" => $type,
                "method" => $method_msg
            )
            );
            if ($q) {
                //   if($type=="Withdrawal")
                //   {
                //       $remainAmount=$this->input->post('wallet');
                //       $qupdate=$this->db->query("update tblwallet set wallet_points='".$remainAmount."' where user_id='".$user_id."'");
                //   }
                $data["responce"] = true;
                $data["message"] = "Request Added..";
            } else {
                $data["responce"] = false;
                $data["error"] = "Something Went Wrong";
            }


        }
        echo json_encode($data);
    }

    public function withdraw_request()
    {

        $user_id = $_POST['user_id'];
        $points = $_POST['points'];
        $request_status = $_POST['request_status'];

        $q = "insert into tblWithdrawRequest (withdraw_points,user_id,withdraw_status) values('$points', '$user_id', '$request_status');";
        // echo $q;    
        $dd = $this->conn->query($q);
        if ($dd === TRUE) {
            $status = "success";
            $dt = array("status" => $status);
            echo json_encode($dt);
        } else {
            $status = "failed";
            $dt = array("status" => $status);
            echo json_encode($dt);
        }
    }

    public function request_history()
    {

        $data = array();
        $_POST = $_REQUEST;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["error"] = strip_tags($this->form_validation->error_string());
        } else {
            $data["responce"] = true;
            $q = $this->db->query("select * from tblRequest where user_id='" . $this->input->post('user_id') . "' ORDER BY time DESC");
            $data['data'] = $q->result();
        }
        echo json_encode($data);


    }

    public function withdraw_history()
    {

        $us_id = $_POST['user_id'];
        //$us_id=7;

        $q = "select * from tblWithdrawRequest where user_id=$us_id ORDER BY time DESC";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status = "success";
                $data[] = $row;
            }
        } else {
            $status = "failed";
            $data = "No Withdraw History";
        }

        $obj = array('status' => $status, 'data' => $data);
        echo json_encode($obj);

    }

    public function notifications()
    {

        $email = $_POST['mobile'];

        // $email='anasmansoori734@gmail.com';


        $ds = "SELECT * FROM user_profile where mobileno='$email'";
        $results = mysqli_query($this->conn, $ds);
        if ($results->num_rows > 0) {
            while ($row2 = $results->fetch_assoc()) {
                $data_time = $row2['time'];

            }

            $d = "SELECT * FROM tblNotification where time>='$data_time' ORDER BY notification_id DESC";
            $result1 = mysqli_query($this->conn, $d);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $data[] = $row1;

                }

                $status = "success";



            } else {
                $data = "There is no new notification";
                $status = "unsuccessfull";
                //echo json_encode($data);
            }

            $obj = array("status" => $status, "data" => $data);
            echo json_encode($obj);

        } else {
            $data_time = "Nothing";
        }


    }

    public function transaction()
    {

        $us_id = $_POST['us_id'];
        // $us_id=7;


        $q = "select * from  history where user_id='$us_id' ORDER BY time DESC";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $status = "success";
        } else {
            $status = "failed";
            $data = "No History for you";
        }

        $obj = array("status" => $status, "msg" => $data);
        echo json_encode($obj);
    }

    public function getUserDetails()
    {

        $us_id = $_POST['user_id'];
        // $us_id=3;

        $data = array();
        $data['response'] = true;
        $q = "select * from  user_profile where id='$us_id'";
        $result = $this->db->query($q)->result();

        $data['data'] = $result;
        echo json_encode($data);

    }

    function get_time_slots()
    {

        $data = array();
        $q = "select * from  timeslots";
        $result = mysqli_query($this->conn, $q);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row_data[] = $row;
            }
            $q1 = "select * from  app_setting";
            $result1 = mysqli_query($this->conn, $q1);
            $row1 = $result1->fetch_assoc();

            $data['responce'] = true;
            $data['data'] = $row_data;
            $data['min_amount'] = $row1['w_amount'];
            $data['withdraw_limit'] = $row1['withdraw_limit'];
            $data['w_saturday'] = $row1['w_saturday'];
            $data['w_sunday'] = $row1['w_sunday'];
            $data['min_wallet'] = $row1['min_wallet'];
            $data['min_wallet_msg'] = $row1['min_wallet_msg'];

        } else {
            $data['responce'] = false;
            $data['message'] = "No time slots available";
        }

        echo json_encode($data);
    }

    public function change_notificaton_setting()
    {
        $user_id = $this->input->post("user_id");
        $status = $this->input->post("notification");

        $this->load->model("common_model");
        $dd = $this->common_model->data_update("user_profile", array("on_notif" => $status), array("id" => $this->input->post("user_id")));
        if ($dd) {
            $status = "success";
            $data = "Notification setting updated successfully.";
        } else {
            $status = "failed";
            $data = "Something went wrong";
        }
        $obj = array('status' => $status, 'message' => $data);
        echo json_encode($obj);
    }

    public function get_notif_setting()
    {
        $user_id = $this->input->post("user_id");
        if ($user_id != "") {
            $q = $this->db->select('on_notif')->where('id', $user_id)->get('user_profile')->row();
            $status = "success";
            $message = "Success";
            $data = $q;
        } else {
            $status = "failed";
            $message = "Something went wrong";
            $data = "";
        }
        $obj = array('status' => $status, 'message' => $message, 'data' => $data);
        echo json_encode($obj);
    }

    public function unset_token()
    {
        $data = array();
        $_POST = $_REQUEST;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
        $this->form_validation->set_rules('mobileno', 'User Mobile', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["error"] = strip_tags($this->form_validation->error_string());
        } else {
            $arr = array(
                "user_ios_token" => ""
            );
            $this->db->where('mobileno', $this->input->post('mobileno'));
            $this->db->where('id', $this->input->post('user_id'));
            $this->db->update('user_profile', $arr);

            $data["responce"] = true;
            $data["data"] = "Logout Successfully.";
        }
        echo json_encode($data);
    }

    public function change_password()
    {
        $mobile = $this->input->post('mobile');
        $new_pass = $this->input->post('new_password');
        $old_pass = $this->input->post('old_password');

        $this->load->model("common_model");
        $q = $this->db->query("select * from user_profile where mobileno='$mobile' limit 1");
        $userdata = $q->row();
        // print_r($userdata->password);
        // die;
        if ($q->num_rows() > 0) {
            if ($old_pass === $userdata->password) {
                $update = array("password" => $new_pass);
                $dd = $this->db->where('mobileno', $mobile)->update('user_profile', $update);

            } else {
                $msg = 'You have entered wrong old password.';
            }
        } else {
            $msg = 'No user found.';
        }

        if ($dd) {
            $status = "success";
            $data = "Password updated successfully.";
        } else {
            $status = "failed";
            $data = $msg;
        }
        $obj = array('status' => $status, 'message' => $data);
        echo json_encode($obj);


    }
    public function getstarline_history()
    {
        $data = array();
        $user_id = $this->input->post('user_id');
        $page = $this->input->post('page');
        $from_date = $this->input->post('from_date') ?? date('Y-m-d');
        $to_date = $this->input->post('to_date') ?? date('Y-m-d');
        // $user_id=1;
        // $page = 1;
        $page_limit = 10;
        $limit = "";
        if ($page != "") {
            $limit .= " limit " . (($page - 1) * $page_limit) . "," . $page_limit . " ";
        }
        $data["responce"] = true;
        $q = $this->db->query("SELECT tblgamedata.*,tblStarline.s_game_time as name FROM `tblgamedata` JOIN tblStarline ON tblStarline.id=tblgamedata.matka_id WHERE user_id='" . $user_id . "' and matka_id>20 AND DATE(tblgamedata.time) >= '" . $from_date . "'AND DATE(tblgamedata.time) <= '" . $to_date . "' ORDER BY `id` DESC $limit ");
        $data['data'] = $q->result();

        $q1 = $this->db->query("SELECT tblgamedata.*,tblStarline.s_game_time as name FROM `tblgamedata` JOIN tblStarline ON tblStarline.id=tblgamedata.matka_id WHERE user_id='" . $user_id . "' and matka_id>20   AND DATE(tblgamedata.time) >= '" . $from_date . "'AND DATE(tblgamedata.time) <= '" . $to_date . "' ORDER BY `id` DESC");
        $data['total_data'] = $q1->num_rows();
        echo json_encode($data);

    }
    public function get_win_history()
    {
        $data = array();
        $_POST = $_REQUEST;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
        $from_date = $this->input->post('from_date') ?? date('Y-m-d');
        $to_date = $this->input->post('to_date') ?? date('Y-m-d');

        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["error"] = strip_tags($this->form_validation->error_string());
        } else {
            $user_id = $this->input->post('user_id');
            $page = $this->input->post('page');
            // $user_id=3;
            $page_limit = 10;
            $limit = "";
            if ($page != "") {
                $limit .= " limit " . (($page - 1) * $page_limit) . "," . $page_limit . " ";
            }
            $q = $this->db->query("SELECT `tblgamedata`.*,`history`.`amt`, `matka`.`name` , `tblgame`.`name` as `game_name` FROM `tblgamedata`
                                JOIN `matka` ON `matka`.`id`=`tblgamedata`.`matka_id`
                                JOIN `tblgame` ON `tblgame`.`game_id`=`tblgamedata`.`game_id`
                                LEFT JOIN `history` ON `history`.`bid_id`=`tblgamedata`.`id`
                                WHERE `tblgamedata`.`status` = 'win'
                                AND `history`.`type` = 'c'
                                AND `tblgamedata`.`user_id` = '" . $user_id . "'
                                AND DATE(tblgamedata.time) >= '" . $from_date . "'
                                AND DATE(tblgamedata.time) <= '" . $to_date . "'
                                ORDER BY `tblgamedata`.`time` DESC $limit");

            $data['data'] = $q->result();
            //  echo $this->db->last_query();die();
            $data["responce"] = true;

            $data['total_data'] = $q->num_rows();
            // print_r($this->db->last_query());
        }
        echo json_encode($data);
    }

    public function get_starlinewin_history()
    {
        $data = array();
        $_POST = $_REQUEST;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
        $from_date = $this->input->post('from_date') ?? date('Y-m-d');
        $to_date = $this->input->post('to_date') ?? date('Y-m-d');

        if ($this->form_validation->run() == FALSE) {
            $data["responce"] = false;
            $data["error"] = strip_tags($this->form_validation->error_string());
        } else {
            $user_id = $this->input->post('user_id');
            $page = $this->input->post('page');
            // $user_id=3;
            $page_limit = 10;
            $limit = "";
            if ($page != "") {
                $limit .= " limit " . (($page - 1) * $page_limit) . "," . $page_limit . " ";
            }
            $q = $this->db->query("SELECT `tblgamedata`.*,`history`.`amt`, `tblStarline`.`s_game_time` as `name`, `tblgame`.`name` as `game_name` FROM `tblgamedata`
                                JOIN `tblStarline` ON `tblStarline`.`id`=`tblgamedata`.`matka_id`
                                JOIN `tblgame` ON `tblgame`.`game_id`=`tblgamedata`.`game_id`
                                LEFT JOIN `history` ON `history`.`bid_id`=`tblgamedata`.`id`
                                WHERE `tblgamedata`.`status` = 'win'
                                AND `history`.`type` = 'c'
                                AND `tblgamedata`.`user_id` = '" . $user_id . "'
                                AND DATE(tblgamedata.time) >= '" . $from_date . "'
                                AND DATE(tblgamedata.time) <= '" . $to_date . "'
                                ORDER BY `tblgamedata`.`time` DESC $limit");

            $data['data'] = $q->result();
            //  echo $this->db->last_query();die();
            $data["responce"] = true;

            $data['total_data'] = $q->num_rows();
            // print_r($this->db->last_query());
        }
        echo json_encode($data);
    }
    public function block_user()
    {
        $user_id = $this->input->post('user_id');
        $dd = $this->db->where('id', $user_id)->get('user_profile')->row();

        if ($dd) {
            $status = "success";
            $data = $dd->status;
        }

        $obj = array('status' => $status, 'data' => $data);
        echo json_encode($obj);
    }

    public function user_status()
    {
        $user_id = $this->input->post('user_id');
        $dd = $this->db->where('id', $user_id)->get('user_profile')->row();

        if ($dd) {
            $status = "success";
            $data = $dd->bank_status;
        }

        $obj = array('status' => $status, 'data' => $data);
        echo json_encode($obj);
    }

    public function get_user_name()
    {
        $data = array();

        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        if ($this->form_validation->run() == TRUE) {
            $mobile = $this->input->post('mobile');

            $user_data_no = $this->db->where('mobileno', $mobile)->get('user_profile')->num_rows();
            if ($user_data_no > 0) {
                $user_data = $this->db->where('mobileno', $mobile)->get('user_profile')->row();
                $array = array(
                    'name' => $user_data->name,
                    'username' => $user_data->username,
                );
                $data['response'] = true;
                $data['data'] = $array;
                // $data['message']=  'Success'; 
            } else {
                $data['response'] = false;
                $data['data'] = array();
                $data['message'] = 'Mobile Number Does Not Exits';
            }
        } else {
            $data['response'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data);
    }
    public function user_transfer_request()
    {
        $data = array();
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        $this->form_validation->set_rules('request_amount', 'Request_amount', 'required');
        $this->form_validation->set_rules('commission', 'Commission', 'required');
        $this->form_validation->set_rules('transfer_userid', 'Transfer_userid', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            $commission = $this->input->post('commission');
            $request_amount = $this->input->post('request_amount');
            $mobile = $this->input->post('transfer_userid');
            $user_id = $this->input->post('user_id');

            $user_data_no = $this->db->where('mobileno', $mobile)->get('user_profile')->num_rows();
            $user_data_for_wallet = $this->db->where('id', $user_id)->get('user_profile')->row();
            $user_wallet_data = $this->db->where('user_id', $user_data_for_wallet->id)->get('tblwallet')->row();
            // print_r($user_wallet_data);exit;
            if ($user_data_no > 0) {
                if ($user_wallet_data->wallet_points >= $request_amount) {
                    $user_data = $this->db->where('mobileno', $mobile)->get('user_profile')->row();
                    //  echo $this->db->last_query();die();
                    $user_data2 = $this->db->where('id', $user_id)->get('user_profile')->row();
                    $mobile2 = $user_data2->mobileno;
                    $transfer_userid = $user_data->id;

                    $fee = $this->db->select('transfer_fee')->get('app_setting')->row();
                    $charge2 = $fee->transfer_fee;
                    $main_charge = ($request_amount) * $charge2 / 100;

                    if ($commission == 0) {
                        $ar_commission = $commission;
                    } else {
                        if ($main_charge == $commission) {
                            $ar_commission = $commission;
                        } else {
                            $data['response'] = false;
                            $data['message'] = 'Something went wrong';
                        }

                    }
                    $array = array(
                        'sender_id' => $this->input->post('user_id'),
                        'receiver_id' => $transfer_userid,
                        'request_points' => $request_amount,
                        'type' => 'transfer',
                        // 'comment'=>"Sent to  $mobile and Received From  $mobile2",

                        'request_status' => 'approved',
                    );

                    $this->db->insert('tbltransfer_request', $array);
                    $array2 = array(
                        'user_id' => $this->input->post('user_id'),
                        'request_points' => $request_amount,
                        'type' => 'send',
                        'comment' => "Sent to  $mobile",
                        'request_status' => 'approved',
                    );
                    $array4 = array(
                        'user_id' => $transfer_userid,
                        'request_points' => $request_amount,
                        'type' => 'received',
                        'comment' => "Received From  $mobile2",
                        'request_status' => 'approved',
                    );
                    $x = $this->db->insert('tblRequest', $array2);
                    $x1 = $this->db->insert('tblRequest', $array4);

                    $total = $request_amount + $commission;
                    $total = $request_amount;
                    $this->Administrator_Model->add_wallet2($user_id, -$total);
                    $this->Administrator_Model->add_wallet2($transfer_userid, $request_amount);
                    $data['response'] = true;
                    $data['message'] = 'Success';
                } else {
                    $data["response"] = false;
                    $data["message"] = "Amount must be greater than or equal wallet amount";
                }
            } else {
                $data['response'] = false;
                $data['message'] = 'Mobile Number Does Not Exits';
            }


        } else {
            $data['response'] = false;
            $data['message'] = strip_tags($this->form_validation->error_string());
        }

        echo json_encode($data);

    }
    public function add_user_enquiry()
    {
        $user_id = $this->input->post('user_id');
        $query = $this->input->post('query');
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $array = array(
            'user_id' => $user_id,
            'query' => $query,
            'email' => $email,
            'status' => 1,
        );
        $x = $this->db->insert('enquiry', $array);
        if ($x) {
            $data['response'] = true;
            $data['message'] = 'Enquiry sent successfully.';
        } else {
            $data['response'] = false;
            $data['message'] = 'Unable to save enquiry.';
        }
        echo json_encode($data);
    }

    public function transfer_point_history()
    {
        $data = array();

        $user_id = $this->input->post('user_id');
        $from_date = $this->input->post('from_date') ?? date('Y-m-d');
        $to_date = $this->input->post('to_date') ?? date('Y-m-d');
        $page = $this->input->post('page');

        $page_limit = 10;
        $limit = "";
        if ($page != "") {
            $limit .= " limit " . (($page - 1) * $page_limit) . "," . $page_limit . " ";
        }
        //    $q = $this->db->query("SELECT `tblgamedata`.*,`history`.`amt`, `matka`.`name` , `tblgame`.`name` as `game_name` FROM `tblgamedata`
        $q = $this->db->query("SELECT `tbltransfer_request`.*,`tblRequest`.`comment`  FROM `tbltransfer_request`
                               JOIN `tblRequest` ON `tblRequest`.`user_id`=`tbltransfer_request`.`sender_id`
                                WHERE  DATE(tbltransfer_request.time) >= '" . $from_date . "'
                                AND DATE(tbltransfer_request.time) <= '" . $to_date . "'
                                 AND (`tbltransfer_request`.`sender_id` = '" . $user_id . "'
                                AND `tblRequest`.`type` = 'send'
                                OR `tbltransfer_request`.`receiver_id` = '" . $user_id . "'
                                AND `tblRequest`.`type` = 'received')
                                GROUP BY `tbltransfer_request`.`request_id` 
                                ORDER BY `tbltransfer_request`.`time` DESC $limit");

        $userdata = $q->result_array();
        //   echo $this->db->last_query();die();

        if (!empty($userdata)) {
            foreach ($userdata as $post) {

                $data_user[] = array(
                    'sender_name' => fullNamewithMob($post['sender_id']),
                    'receiver_name' => fullNamewithMob($post['receiver_id']),
                    'points' => $post['request_points'],
                    'date' => date("d/m/Y h:i:s A", strtotime($post['time'])),
                    'type' => $post['type'],
                    'comment' => $post['comment'],
                );
            }
            $data['response'] = true;
            $data['data'] = $data_user;
            $data['total_data'] = $q->num_rows();
        } else {
            $data['response'] = false;
            $data['data'] = array();
            $data['message'] = "Data not found";
        }
        echo json_encode($data);

    }

}