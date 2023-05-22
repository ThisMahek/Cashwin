<?php date_default_timezone_set("Asia/Calcutta"); //India time (GMT+5:30) echo date('d-m-Y H:i:s'); ?>
<?php
//include('sms_helper.php');
global $conn;
$conn = mysqli_connect('localhost','rdgames_newdatabase', 'rdgames_newdatabase','rdgames_newdatabase') or die("Error in connection.");

if(isset($_GET['api'])) {
    echo $_GET['api']();
}
    
    
function getIndex()
{
    // $data['api']="welcome";
    // $data['version']="3";
    // $data['message']="de";
    // send_sms('8081031624','malamaal');
    // $data['link']="https://play.google.com/store/apps/details?id=in.games.jannat&hl=en";
    // $data['home_text']="admin: 7777777777 \n co-admin: 7777777777 \n ";
    // $data['withdraw']="vishwash ka dusra naam king starline";
    // $data['tag_line']="vishwash ka dusra naam king starline";
    // $data['min_amount']="1000";
    $data=array();
    global $conn;
    $q="select * from app_setting";
     $result = mysqli_query($conn,$q);
     if($result->num_rows > 0)
     {
     $data['responce']=true;
     $data['data']=$result->fetch_assoc();
       
     }
     else
     {
   $data['responce']=false;
     $data['message']="Something went wrong";
         
     }
     
    echo json_encode($data);
}

function sign_up()
{
    global $conn;
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $pass=$_POST['password'];
    
    $q="insert into user_profile (name,username,mobileno,password,login_status) values('$name','$name','$mobile','$pass','0')";
    $dd=$conn->query($q);
    if($dd === TRUE)
    {
        $status="success";
        $msg="Registered Successfully";
    } else {
        $status="failed";
        $msg="Something went wrong \n Please try again later";
    }
    $obj=array('status'=>$status,'message'=>$msg);
    echo json_encode($obj);

}

 function get_account_details(){
     global $conn;
     $data=array();
    $q = "select * from account_details";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $status="success";
            $data = $row;
        }
    } else {
        $status="success";
        $data[] = "0";
    }
    
    $obj=array("status"=>$status, "data"=>$data);
    echo json_encode($obj);
            } 
//Upload screenshot
        function upload_image()
        {
          if(isset($_FILES["uploaded_file"]["name"]))
            {
            $name=$_FILES['uploaded_file']['name'];
            $tmp_name=$_FILES['uploaded_file']['tmp_name'];
            $error=$_FILES['uploaded_file']['error'];
    
         if(!empty($name))
         {
          $location='../uploads/';
         if(!is_dir($location))
         {
             mkdir($location);
         }
        if(move_uploaded_file($tmp_name,$location.$name))
        {
            echo 'uploaded';
        }
        else 
        echo 'choose image file';
      }
    }    
   }
   
   function addTransactions()
   {
       $data=array();
       global $conn;
       $us_id=$_POST['id'];
       $trans_id=$_POST['trans_id'];
       $name=$_POST['trans_name'];
       
      $q1="insert into user_transactions (user_id,trans_id,screenshot) values('".$us_id."','".$trans_id."','".$name."')  ";
          $dd = mysqli_query($conn, $q1);
          if($dd)
          {
              $data['status']=true;
              $data['message']="Transcation Details add successfully.";
          }
          else
          {
              $data['status']=false;
              $data['error']="Something Went wrong";
          }
      
       echo json_encode($data);
   }
   
function getMatkas()
{
    global $conn;
    $row_dt="";
    $matka=array();
    $q = "select * from matka";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        $i = 0;
        $curr_time = strtotime(date('H:i:s'));
        while($row = $result->fetch_assoc()) {
          if(date('D')==='Sat') {
            $bid_start_time = $row['sat_start_time'];
            $bid_end_time = $row['sat_end_time'];
          }
          if(date('D')==='Sun') {
            $bid_start_time = $row['start_time'];
            $bid_end_time = $row['end_time'];
          }
          else
          {
               $bid_start_time = $row['start_time'];
            $bid_end_time = $row['end_time'];
          }
          $type = (($curr_time>=strtotime($bid_start_time)) && ($curr_time<=strtotime($bid_end_time)))?"live":"old";
          $data[$i]= $row;
          $data[$i]['bid_start_time'] = $bid_start_time;
          $data[$i]['bid_end_time'] = $bid_end_time;
          $data[$i]['type'] = $type;
          $i++;
        }
        
        
    } 
    else {
        $data = "0";
    }
    
  echo json_encode($data);
   
}

function getStarline()
{
    global $conn;
    $q = "select * from tblStarline where s_game_time !=''";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
          $data[$i]['id'] = $row['id'];
          $data[$i]['s_game_time'] = $row['s_game_time'];
          if(strtotime(date('Y-m-d')) == strtotime(date('Y-m-d', strtotime($row['updated_at']))))
            $data[$i]['s_game_number'] = $row['s_game_number'];
          else
            $data[$i]['s_game_number'] = "****";
            
          $i++;
        }
    } else {
        $data = "0";
    }
    echo json_encode($data);
}

function get_matka_with_id()
{
    global $conn;
    $us_id=$_POST['id'];
    //$us_id=2;
    
    $q = "select * from  matka where id=$us_id";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $status="success";
            $data = $row;
        }
    } else {
        $status="success";
        $data[] = "0";
    }
    
    $obj=array("status"=>$status, "data"=>$data);
    echo json_encode($obj);
}

function how_to_play()
{
    $hto="Value1 is here .....";   
    $hto2="https://jannatmatka.in";
    $x['data']=$hto;
    $x['link']=$hto2;
    $obj=array($x);
    echo json_encode($obj);
}

function user_login()
{
    global $conn;
   $email  = $_POST['mobileno'];
   $pass = $_POST['password'];
//   $email  = 8081031624;
//   $pass='Dsp@123';
//   $otp='8592';
//   $otp=$_POST['otp'];
	$q="select * from user_profile where mobileno='$email'";
	$result = mysqli_query($conn,$q);
	//header("location:usersdata.php");
	
	if(mysqli_num_rows($result)==1)
	{
	    $row=mysqli_fetch_assoc($result);
	    $db_pass=$row['password'];
	   // $db_otp=$row['otp'];
	    if($pass == $db_pass)
	    {
	       // if($otp == $db_otp)
	       // {
	            $status="success";
	            $data['id']=$row['id'];
	            $data['name']=$row['name'];
	            $data['username']=$row['username'];
	            $data['mobileno']=$row['mobileno'];
	            $data['password']=$row['password'];
	            $data['email']=$row['email'];
	            $data['address']=$row['address'];
	            $data['city']=$row['city'];
	            $data['pincode']=$row['pincode'];
	            $data['password']=$row['password'];
	            $data['accountno']=$row['accountno'];
	            $data['bank_name']=$row['bank_name'];
	            $data['ifsc_code']=$row['ifsc_code'];
	            $data['account_holder_name']=$row['account_holder_name'];
	            $data['paytm_no']=$row['paytm_no'];
	            $data['tez_no']=$row['tez_no'];
	            $data['phonepay_no']=$row['phonepay_no'];
	           
	       // }
	       // else
	       // {
	            
	       //   $status="failed";
	       //     $data="OTP is Incorrect";
	       //}
	    }
	    else
	    {
	    $status="failed";
	    $data="Password is incorrect";    
	    }
	}
	else
	{
	    $status="failed";
	    $data="Mobile Number not exist...";
	    
	}
	
	  $obj=array("status"=>$status, "data"=>$data);
    echo json_encode($obj);
}

function setAsLogin(){
    global $conn;
    $email  = $_POST['email'];
    $q1="update user_profile set login_status='1' where email='$email'";
    if(mysqli_query($conn,$q1))
        echo json_encode(array("status"=>"success"));
}

function setAsLogout(){
    global $conn;
    $email  = $_POST['email'];
    $q1="update user_profile set login_status='0' where email='$email'";
    if(mysqli_query($conn,$q1))
        echo json_encode(array("status"=>"success"));
}
function getNotice()
{
    global $conn;
    
    $q="Select * from tblNotice";
    $result=mysqli_query($conn,$q);
     if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $status="success"; 
          $data[] = $row;
        }
    }
    else
    {
         $status="failed";
          $data = "null";
    }
    $obj=array('status'=>$status,'data'=>$data);
    echo json_encode($obj);
}

function getWalletAmount()
{
    
    global $conn;
    $user_id  = $_POST['user_id'];
    $result = mysqli_query($conn, "SELECT COUNT(*) as co FROM tblwallet where user_id='".$user_id."'") or die("some err");
    $row=mysqli_fetch_assoc($result);
    $cnt=$row['co'];
    if($cnt==1) {
  	    $q="select * from tblwallet where user_id='$user_id'";
 	    $result = mysqli_query($conn,$q);
	    //header("location:usersdata.php");
		if(mysqli_num_rows($result)==1)
	{
	    $row1=mysqli_fetch_assoc($result);
	        
	}
	$status="success";
	$data=$row1;
//	echo json_encode($row1);


}
else
{
    $status="failed";
	$data=$cnt;
   
}
	$obj=array('status'=>$status,'message'=>$data);
echo json_encode($obj);
	
}

function test()
{
    global $conn;
    $m =21;
    $q1 = "select * from tblStarline where id = '$m'";
    $result = mysqli_query($conn, $q1) or die("some err");
    $row=mysqli_fetch_assoc($result);


    $st = $et = "s_game_time";
    $time = $row[$st];

    echo strtotime(date('h:i A'))."<hr>".time();
}

function insert_data()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT MAX(id) as c FROM tblgamedata") or die("some err");
    if($row=mysqli_fetch_assoc($result))
        $maxid =  $row['c']++;
    $jsonArr=$_POST['data'];
   // [{"points":"[10, 10, 10, 10, 10]","digits":"["1", "3", "5", "7", "9"]","bettype":"[0,0, 0,0,0]","user_id":"10","matka_id":"2","date":"07/09/2019","game_id":"1"}]
    //$jsonArr = '[{"points":"[10, 10, 10, 10, 10]","digits":"[\"1\", \"3\", \"5\", \"7\", \"9\"]","bettype":"[0,0,0,0,0]","user_id":"4","matka_id":"4","date":"09/09/2019","game_id":"1"}]';
    if(empty($jsonArr))
        $status="failed1";
    else {
        //[{"points":"[10, 10, 10, 10, 10]","digits":"[121-345, 3, 5, 7, 9]","bettype":"[Opening Bet, Opening Bet, Opening Bet, Opening Bet, Opening Bet]","user_id":"2","matka_id":"2","date":"15/02/2001"}]
        
        $json = json_decode($jsonArr);
        foreach($json as $js):
            $ponts = $i = $e = 0;
            $points = json_decode($js->points);
            $digits = json_decode($js->digits);
            $bettype = json_decode($js->bettype);

            $u = $js->user_id;
            $m = $js->matka_id;
            $dx = $js->date;
            $gm= $js->game_id;
            
            if($m<=14):
                $q1 = "select * from matka where id = '$m'";
                $st = (date('D')==='Sat')?'sat_start_time':((date('D')==='Sun')?'start_time':'bid_start_time');
                $et = (date('D')==='Sat')?'sat_end_time':((date('D')==='Sun')?'end_time':'bid_end_time');
            else:
                $q1 = "select * from tblStarline where id = '$m'";
                $st = $et = "s_game_time";
            endif;
            
            $dd = mysqli_query($conn, $q1) or die("some err1");
            if($row1=mysqli_fetch_assoc($dd)) {
                // $stime = $row1[$st];
                // $etime = $row1[$et];
                $a_time = strtotime(date('h:i A'));
                $time1 = ($bettype[$i]==0)?$row1[$st]:$row1[$et];
                $time = date('h:i A', strtotime($time1));
                if(($a_time <= strtotime($time)) || (strtotime(date('Y-m-d')) < strtotime(date('Y-m-d', strtotime($dx))))):
                    
                    $q2 = "select * from tblwallet where user_id = '$u'";
                    $dd1 = mysqli_query($conn, $q2) or die("some err2");
                    $row2=mysqli_fetch_assoc($dd1);
                    if(count($row2)>0):
                        $wallet_amt = $row2['wallet_points'];
                        foreach($points as $pa):
                            $p = $points[$i];
                            $wallet_amt = $wallet_amt-$p;
                            if($wallet_amt>=0):
                                $ponts += $p;
                                $d = (string)$digits[$i];
                                $bt = ($bettype[$i]==0)?"open":"close";
                                
                                $q="insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm')";
                                $dd = mysqli_query($conn, $q) or die("some err3");
                                $maxid++;
                                $qs="insert into history (user_id,matka_id,amt,digits,bid_id,date,type,game_id) values('$u', '$m', '$p', '$d','$maxid', '$dx', 'd','$gm')";
                                $dds = mysqli_query($conn, $qs) or die("some err4");
                                $i++;
                            endif;
                        endforeach;
                    endif;
                else:
                    $status="timeout";
                endif;
            }
        if($ponts>0)
        {
            if(count($row2)>0)
                $q = "update tblwallet set wallet_points = wallet_points-$ponts where user_id = '$u'";
            else
                $q = "insert into tblwallet (wallet_points, user_id) VALUES (0, '$u')";
            $dd = mysqli_query($conn, $q) or die("some err5");
        }            
        endforeach;

    	if(($dds===TRUE) && ($status!="timeout")) {
    	    $status="success";
            $dt = array("status" => $status);
            echo json_encode($dt);
            return false;
    	}
    	elseif($status==null)
    	{
    	    $status="failed";
    	}
        elseif($status=="timeout")
        {
            $status="timeout";
        }
    }
    $dt=array("status"=>$status);
    echo json_encode($dt);
}

function getMobile()
{
    global $conn;
    $q = "select mobile from site_config";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0)
    {
        $data = $result->fetch_assoc();
         $data['count']=20;
         $data['starline']="https://www.binplus.in";
         $data['chart1']="https://serveradda.com/billing";
         $data['chart2']="https://www.google.com";
    }
    else
    {
        $data['mobile']="XXXXXXXXXXXX";
        $data['count']=20;
    $data['starline']="https://www.binplus.in";
         $data['chart1']="https://serveradda.com/billing";
         $data['chart2']="https://www.google.com";
    }
        
        //$obj=array('data'=>$data,'count'=>$cnt);
    //7354224579
    echo json_encode($data);
}

function insert_sangam_data()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT MAX(id) as c FROM tblgamedata") or die("some err");
    $a_time = strtotime(date('h:i A'));
    if($row=mysqli_fetch_assoc($result))
        $maxid=  $row['c']++;
    $jsonArr=$_POST['data'];
    if(empty($jsonArr))
        $status="failed1";
    else {
        $json = json_decode($jsonArr);
        foreach($json as $js):
            $ponts = $i = $e = 0;
            $points = json_decode($js->points);
            $digits = json_decode($js->digits);
            $bettype = json_decode($js->bettype);

            $u = $js->user_id;
            $m = $js->matka_id;
            $dx = $js->date;
            $gm= $js->game_id;

            $q1 = "select * from matka where id = '$m'";
            $dd = mysqli_query($conn, $q1) or die("some err1");

            $st = (date('D')==='Sat')?'sat_start_time':((date('D')==='Sun')?'start_time':'bid_start_time');
            $et = (date('D')==='Sat')?'sat_end_time':((date('D')==='Sun')?'end_time':'bid_end_time');
            if($row1=mysqli_fetch_assoc($dd)) {
                // $stime = $row1[$st];
                // $etime = $row1[$et];
                $time1 = ($bettype[$i]==0)?$row1[$st]:$row1[$et];
                $time = date('h:i A', strtotime($time1));                
                if(($a_time <= strtotime($time)) || (strtotime(date('Y-m-d')) < strtotime($dx))):
                    
                    $q2 = "select * from tblwallet where user_id = '$u'";
                    $dd1 = mysqli_query($conn, $q2) or die("some err2");
                    $row2=mysqli_fetch_assoc($dd1);
                    if(count($row2)>0):
                        $wallet_amt = $row2['wallet_points'];

                        foreach($points as $pa):
                            $p = $points[$i];
                            $wallet_amt = $wallet_amt-$p;
                            if($wallet_amt>=0):
                                $ponts += $p;
                                $d = (string)$digits[$i];
                                $bt = (string)$bettype[$i];
                                
                                $q="insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm')";
                                $dd = mysqli_query($conn, $q) or die("some err3");
                                $maxid++;
                                $qs="insert into history (user_id,matka_id,amt,digits,bid_id,date,type,game_id) values('$u', '$m', '$p', '$d','$maxid', $dx, 'd','$gm')";
                                $dds = mysqli_query($conn, $qs) or die("some err4");
                                $i++;
                            endif;
                        endforeach;
                    endif;
                else:
                    $status="timeout";
                endif;
            }
        if($ponts>0)
        {
            if(count($row2)>0)
                $q = "update tblwallet set wallet_points = wallet_points-$ponts where user_id = '$u'";
            else
                $q = "insert into tblwallet (wallet_points, user_id) VALUES (0, '$u')";
            $dd = mysqli_query($conn, $q) or die("some err5");
        }            
        endforeach;

    	if(($dds===TRUE) && ($status!="timeout")) {
    	    $status="success";
            $dt = array("status" => $status);
            echo json_encode($dt);
            return false;
    	}
    	elseif($status==null)
    	{
    	    $status="failed";
    	}
        elseif($status=="timeout")
        {
            $status="timeout";
        }
    }
    $dt=array("status"=>$status);
    echo json_encode($dt);
//     $q1="SELECT MAX(id) FROM tblgamedata";
//     $d2 = $conn->query($q1);
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
//              $dd = $conn->query($q);
//                     $px="d";
//                     // echo $gm;
//                     $maxid++;
//                     $qs="insert into history (user_id,matka_id,amt,digits,bid_id,date,type,game_id) values('$u', '$m', '$p', '$d','$maxid', '$dx', '$px','$gm')";
//                     $dds = $conn->query($qs);

                
                
                
//                 $i++;
//             endforeach;        
//         endforeach;
        
//           if($ponts>0)
//             {
//                 $id = $u;
//                 $q1 = "select * from tblwallet where user_id = '$id'";
//                 $dd1 = $conn->query($q1);
//                 if(count($dd1)>0)
//                     $q = "update tblwallet set wallet_points = wallet_points-'$ponts' where user_id = '$id'";
//                 else
//                     $q = "insert into tblwallet (wallet_points, user_id) VALUES ('-$points', '$id')";
//                 $dd = $conn->query($q);
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

function getBidHistory()
{
    global $conn;
    $us_id=$_POST['us_id'];
    $matka_id=$_POST['matka_id'];
    
    //Odd Even Data

    // $play_for="play_for";
    // $play_on="play_on";
    $play_for = date('Y-m-d');
    $play_on = "";
    
if($matka_id<14)
{
 
     $odd_even = 'tblgamedata.id,tblgamedata.user_id,tblgamedata.matka_id,tblgamedata.points,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.digits,tblgamedata.game_id,tblgamedata.status,matka.name ';
    //$odd_even = 'tblodd_even.id,tblodd_even.user_id,tblodd_even.matka_id,tblodd_even.points,tblodd_even.bet_type,tblodd_even.date,tblodd_even.time,tblodd_even.digits,matka.name';
  $q = "select ".$odd_even." from  tblgamedata JOIN matka ON matka.id=tblgamedata.matka_id where tblgamedata.user_id=$us_id and tblgamedata.matka_id=$matka_id ORDER BY time DESC";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          
          $x['play_for']=$row['time'];
          $x['play_on']=$row['time'];
        $newDate = date("l", strtotime($x['play_on']));
          $x['day']=$newDate;
         $r = array_merge($row, $x);
         $data[] = $r;
        }
    }
    else
    {
        $data[]=null;
    }  
}
else
{
    $d="select tblgamedata.id,tblgamedata.user_id,tblgamedata.matka_id,tblgamedata.points,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.digits,tblgamedata.game_id,tblgamedata.status,tblStarline.s_game_time from tblgamedata,tblStarline where  tblgamedata.user_id=$us_id AND tblgamedata.matka_id=tblStarline.id AND matka_id>'15' ORDER BY time DESC";
     $result1 = mysqli_query($conn,$d);
    if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
          $x['play_for']=$row1['time'];
          $x['play_on']=$row1['time'];
          $newDate = date("l", strtotime($x['play_on']));
          $x['day']=$newDate;
          $r = array_merge($row1,$x);
          $data[] = $r;
        }
    }
    
    else
    {
        $data[]=null;
    }
}
    
    
    echo json_encode($data);
}

function insert_withdraw_request()
{
    global $conn;
    $user_id=$_POST['user_id'];
    $points=-$_POST['points'];
    $date=$_POST['date'];
    $request_status=$_POST['request_status'];
    $req_limit=$_POST['req_limit'];//req_limit
    
    // $user_id=5;
    // $points=-'200';
    // $date='10-08-2020';
    // $request_status="pending";
    // $req_limit=2;//req_limit
    $type="Withdrawal";
    $d="select * from tblRequest where user_id=$user_id and type='Withdrawal'";
    $result1 = mysqli_query($conn,$d);
    if($result1->num_rows>0)
    {	
          while($row = $result1->fetch_assoc())
          {    $newDate = date("d-m-Y", strtotime($row['time']));
              
              $row1[]=$newDate;
          }
        //   print_r($row1);
	    
            $limit_exceed = false;
        // echo $req_limit;
            if(in_array($date, $row1))
    	    {
                 $req_count = count($row1);
                if($req_count>$req_limit)
                    $limit_exceed = true;
    	    }

	        if($limit_exceed){
	            $status="failed";
	            $data="Daily Withdraw limit Exceeded";
	        }

	        else
	        {
	            $q="insert into tblRequest (request_points,user_id,request_status,type) values('$points', '$user_id', '$request_status','$type')";
    // echo $q;    
             $dd = $conn->query($q);
         	if ($dd === TRUE){
         	    	$status="success";
         	    $data="Request Successfull..";
         	}
         	else{
         	    	$status="failed";
         	    $data="Something Went Wrong";
         	}

	        }
	        
	}
	else
	{
	   $q="insert into tblRequest (request_points,user_id,request_status,type) values('$points', '$user_id', '$request_status','$type')";
       $dd = $conn->query($q);
       	if ($dd === TRUE){
    	    	$status="success";
         	    $data="Request Successfull..";
         	}
         	else{
         	    	$status="failed";
         	    $data="Something Went Wrong";
         	}
  
	}


//	echo json_encode($row1);



	$obj=array('status'=>$status,'message'=>$data);
    echo json_encode($obj);
    
}

function generate_otp()
{
    global $conn;
      $mobile=$_POST['mobile'];
      $otp=$_POST['otp'];
      $q="select * from user_profile where mobileno='$mobile'";
       $result = mysqli_query($conn,$q);
       if($result->num_rows > 0)
       {
           send_sms($mobile,$otp);
           
     	    	$status="success";
         	    $data="Code sent to your registered mobile number";
         	}
         	else
         	{
         	    $status="failed";
         	    $data="Mobile number not registered.";
         	}
 
    $obj=array('status'=>$status,'message'=>$data);
    echo json_encode($obj);
}

function mobile_verification()
{
    global $conn;
      $mobile=$_POST['mobile'];
      $otp=$_POST['otp'];
      $q="select * from user_profile where mobileno='$mobile'";
       $result = mysqli_query($conn,$q);
       if($result->num_rows > 0)
       {
           
           
     	    	$status="failed";
         	    $data="Mobile number already registered \n try another number";
         	}
         	else
         	{
         	    send_sms($mobile,$otp);
         	    $status="success";
         	    $data="verification";
         	}
 
    $obj=array('status'=>$status,'message'=>$data);
    echo json_encode($obj);
}

function forgot_password()
{
    global $conn;
      $mobile=$_POST['mobile'];
      $password=$_POST['password'];
      $q="update user_profile set password='$password' where mobileno='$mobile'";
       $dd = $conn->query($q);
         if ($dd === TRUE)
       {
     	    	$status="success";
         	    $data="Password updated successfully.";
         	}
         	else
         	{
         	    $status="failed";
         	    $data="Something went wrong";
         	}
 
    $obj=array('status'=>$status,'message'=>$data);
    echo json_encode($obj);
}

// function for send sms

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
        'password' => "654321",
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

function create_mpin()
{
    global $conn;
    $user_id=$_POST['user_id'];
    $mpin=$_POST['mpin'];
    
    $q="update user_profile set mid='".$mpin."' where id='".$user_id."'";
       $dd = $conn->query($q);
         if ($dd === TRUE)
       {
     	    	$status="success";
         	    $data="MPIN gnerated successfully..";
         	}
         	else
         	{
         	    $status="failed";
         	    $data="Something went wrong";
         	}
 
    $obj=array('status'=>$status,'message'=>$data);
    echo json_encode($obj);
    
}


function generate_login_otp()
{
    global $conn;
    $mobile=$_POST['mobile'];
    $pass=$_POST['password'];
    $otp=$_POST['otp'];
    $q="select * from user_profile where mobileno='$mobile'";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_pass=$row['password'];
        if($pass == $db_pass)
        {
            $status="success";
            $msg="Your login OTP is ".$otp." for SM7 Online";
            send_sms($mobile,$msg);
            $id=$row['id'];
        $u_otp="update user_profile set otp='$otp' where id='$id'";
        $dd = $conn->query($u_otp);
         if ($dd === TRUE)
         {
             $status="success";
             $data="OTP sent to your registered mobile number";
         }
         else
         {
             $status="failed";
            $data="Something went wrong";
         }
        }
        else
        {
            $status="failed";
            $data="Password is incorrect";
        }
        
    }
    else
    {
         $status="failed";
            $data="Mobile Number not registered.";
    }
    
    $obj=array('status'=>$status,'message'=>$data);
    echo json_encode($obj);
    
}


function get_starline()
{
    global $conn;
        $q = "select * from tblStarline where s_game_time !=''";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        $i = 0;
        while($row = $result->fetch_assoc()) {
          $data[$i]['id'] = $row['id'];
          $data[$i]['s_game_time'] = $row['s_game_time'];
          $data[$i]['s_game_end_time'] = $row['s_game_end_time'];
          
          if(strtotime(date('Y-m-d')) == strtotime(date('Y-m-d', strtotime($row['updated_at']))))
            $data[$i]['s_game_number'] = $row['s_game_number'];
          else
            $data[$i]['s_game_number'] = "***";
            
          $i++;
        }
    }
    else
    {
          
          $data = "0";
    }
    
    
    echo json_encode($data);

}


function getSpMotor()
{
    $s=$_POST["arr"];
$a=str_split($s);
$arr=implode($a,",");

$numArray=explode(",",$arr);
$arr = array_map('intval', $numArray);
//print_r( $arr);
$data=array(array(137,128,146,236,245,290),
array(380,470,489,560,678,579),
//array(119,155,227,335,344,399),
//array(588,669,777,100),
array(129,138,147,156,237,246),
array(345,390,480,570,589,679),
//array(110,228,255,336,499,660),
//array(688,778,200,444),
array(120,139,148,157,238,247),
array(256,346,490,580,670,689),
//array(166,229,337,355,445,599),
//array(779,788,300,111),
array(130,149,158,167,239,248),
array(257,347,356,590,680,789),
//array(112,220,266,338,446,455),
//array(699,770,400,888),
array(140,159,168,230,249,258),
array(267,348,357,456,690,780),
//array(113,122,177,339,366,447),
//array(799,889,500,555),
array(123,150,169,178,240,259),
array(268,349,358,367,457,790),
//array(114,277,330,448,466,556),
//array(880,899,600,222),
array(124,160,179,250,269,278),
array(340,359,368,458,467,890),
//array(115,133,188,223,377,449),
//array(557,566,700,999),
array(125,134,170,189,260,279),
array(350,369,378,459,468,567),
//array(116,224,233,288,440,477),
//array(558,990,800,666),
array(126,135,180,234,270,289),
array(360,379,450,469,478,568),
//array(117,144,199,225,388,559),
//array(577,667,900,333),
array(127,136,145,190,235,280),
array(370,389,460,479,569,578),
//array(118,226,244,299,334,488),
//array(668,677,000,550)
);
$a=0;
$b=0;
$a=0;
$k=0;
$t=0;
$m=array();
$final=array();

for($i=0;$i<count($data);$i++){
    for($j=0;$j<count($data[$i]);$j++){
        $k=0;
        $b=0;
        $num=$data[$i][$j];
        while($num!=0){
            $d=$num%10;
            $b++;
            if($b<4){
                if(!(in_array($d,$arr,false)))
                {
                    $k=1;
                    break;
                }
            }
            $num=(int)$num/10;
        }
        if($k==0)
        $m[$a++]=$data[$i][$j];
        
      //              echo $m;
        
        //print_r($m);
        
    }
}
for($i=0;$i<count($m);$i++){
 $b=0;
 $c=0;
 $num=$m[$i];
 while($num!=0){
     $d=$num%10;
     $arr2[$b++]=$d;
     $num=(int)$num/10;
    
//    echo $d;
 }
//  for($j=0;$j<2;$j++){
//      if($arr2[$j]<=$arr2[($j)+1]){
//          $c=1;
//          break;
//      }
//  }
//  if($c==0){
     $final[$t++]=$m[$i];
// }
}
echo json_encode(array("status" => "success", "data" => $final));
}



function get_dpmotor()
{
    $s=$_POST["arr"];
$a=str_split($s);
$arr=implode($a,",");
//echo $arr;
//$arr=$_POST["arr"];
$numArray=explode(",",$arr);
$arr = array_map('intval', $numArray);

$data=array(118,226,244,299,334,488,550,668,677,100,119,155,227,335,344,399,588,669,110,200,228,255,
336,499,660,688,778,166,229,300,337,355,445,599,779,788,112,220,266,338,400,446,455,699,770,113,122,
177,339,366,447,500,799,889,600,114,277,330,448,466,556,880,899,115,133,188,223,377,449,557,566,700,
116,224,233,288,440,477,558,800,990,117,144,199,225,388,559,577,667,900
);
//244,334,155,335,344,255,355,445,112,455,113,122,114,115,133,223,224,233,144,225

$a=0;
$b=0;
$a=0;
$k=0;
$t=0;
$m=array();
$final=array();

for($i=0;$i<count($data);$i++){
    
        $k=0;
        $b=0;
        $num=$data[$i];
        while($num!=0){
            $d=$num%10;
            $b++;
            if($b<4){
            if(!(in_array($d,$arr,false)))
            {
                
                $k=1;
                break;
            }
            
        }
        $num=(int)$num/10;
        }
        if($k==0)
        $m[$a++]=$data[$i];
    
}

for($i=0;$i<count($m);$i++){
 $b=0;
 $c=0;
 $num=$m[$i];
 while($num!=0){
     $d=$num%10;
     $arr2[$b++]=$d;
     $num=(int)$num/10;
 }
 for($j=0;$j<2;$j++){
     if($arr2[$j]<=$arr2[($j)+1]){
         $c=1;
         break;
     }
 }
 if($c==1){
     $final[$t++]=$m[$i];
 }
}


echo json_encode(array("status" => "success", "data" => $final));
}

function get_matkas()
{
    global $conn;
    $row_dt="";
    $matka=array();
    $q = "select * from matka ORDER BY matka_order";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        $i = 0;
        $curr_time = strtotime(date('H:i:s'));
        while($row = $result->fetch_assoc()) {
          if(date('D')==='Sat') {
            $bid_start_time = $row['sat_start_time'];
            $bid_end_time = $row['sat_end_time'];
          }
          if(date('D')==='Sun') {
            $bid_start_time = $row['start_time'];
            $bid_end_time = $row['end_time'];
          }
          else
          {
               $bid_start_time = $row['start_time'];
            $bid_end_time = $row['end_time'];
          }
          $type = (($curr_time>=strtotime($bid_start_time)) && ($curr_time<=strtotime($bid_end_time)))?"live":"old";
          $data[$i]= $row;
          $data[$i]['bid_start_time'] = $bid_start_time;
          $data[$i]['bid_end_time'] = $bid_end_time;
          $data[$i]['type'] = $type;
          $i++;
        }
        
        
    } 
    else {
        $data = "0";
    }
    
  echo json_encode($data);
   
}

function matka_with_id()
{
    global $conn;
    $us_id=$_POST['id'];
    $q = "select * from  matka where id=$us_id ";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $status="success";
          $data = $row;
        }
    }
    else
    {
          $status="success";
          $data[] = "0";
    }
    
$obj=array("status"=>$status, "data"=>$data);
    echo json_encode($obj);
    
}

function starline_data()
{
    global $conn;
    $id=$_POST['id'];
    
    $q = "select * from tblStarline where id=$id";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo json_encode($row);
        }
    }
    else
    {
        echo json_encode("0");
    }
    
}


function request_points()
{
    global $conn;
      $user_id=$_POST['user_id'];
    $points=$_POST['points'];
    $request_status=$_POST['request_status'];
    $type=$_POST['type'];
            
             $q="insert into tblRequest (request_points,user_id,request_status,type) values('$points', '$user_id', '$request_status','$type');";
                 // echo $q;    
         $dd = $conn->query($q);
        
        	if ($dd === TRUE) {
        	    $status="success";
                
                $dt = array("status" => $status);
     echo json_encode($dt);
              
        	}
        	else
        	{
        	    $status="failed";
        	    $dt = array("status" => $status);
     echo json_encode($dt);
        	}
}

function withdraw_request()
{
    global $conn;
        $user_id=$_POST['user_id'];
    $points=$_POST['points'];
    $request_status=$_POST['request_status'];

    $q="insert into tblWithdrawRequest (withdraw_points,user_id,withdraw_status) values('$points', '$user_id', '$request_status');";
    // echo $q;    
    $dd = $conn->query($q);
	if ($dd === TRUE) {
	    $status="success";
        $dt = array("status" => $status);
        echo json_encode($dt);
	} else {
	    $status="failed";
	    $dt = array("status" => $status);
	    echo json_encode($dt);
    }
}

function request_history()
{
    global $conn;
     $us_id=$_POST['user_id'];
//   $us_id=5;
   $q="select * from tblRequest where user_id=$us_id ORDER BY time DESC";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $status="success";
          $data[] = $row;
        }
    }
    else
    {
        $status="failed";
        $data[]="";
    }
    $obj=array('status'=>$status,'data'=>$data);
    echo json_encode($obj);
}

function withdraw_history()
{
    global $conn;
     $us_id=$_POST['user_id'];
    //$us_id=7;
   
   $q="select * from tblWithdrawRequest where user_id=$us_id ORDER BY time DESC";
 $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $status="success";
          $data[] = $row;
        }
    }
    else
    {
        $status="failed";
        $data="No Withdraw History";
    }
    
    $obj=array('status'=>$status,'data'=>$data);
    echo json_encode($obj);
  
}

function notifications()
{
    global $conn;
     $email=$_POST['mobile'];
    
   // $email='anasmansoori734@gmail.com';
    
    
    $ds="SELECT * FROM user_profile where mobileno='$email'";
     $results = mysqli_query($conn,$ds);
    if ($results->num_rows > 0) {
        while($row2 = $results->fetch_assoc()) {
          $data_time= $row2['time'];
          
        }
       
            $d="SELECT * FROM tblNotification where time>='$data_time' ORDER BY notification_id DESC";
     $result1 = mysqli_query($conn,$d);
    if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
          $data[] = $row1;
          
        }
        
        $status="success";

          
    
}
else
{
    $data="There is no new notification";
    $status="unsuccessfull";
      //echo json_encode($data);
}

        $obj=array("status"=>$status, "data"=>$data);
    echo json_encode($obj);
        
    }
        else
        {
            $data_time="Nothing";
        }
         
    
}

function transaction()
{
    global $conn;
    $us_id=$_POST['us_id'];
   // $us_id=7;

    //Odd Even Data

    // $odd_even = 'tblgamedata.id,tblgamedata.user_id,tblgamedata.matka_id,tblgamedata.points,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.digits,tblgamedata.game_id,tblgamedata.status,matka.name ';
    //$odd_even = 'tblodd_even.id,tblodd_even.user_id,tblodd_even.matka_id,tblodd_even.points,tblodd_even.bet_type,tblodd_even.date,tblodd_even.time,tblodd_even.digits,matka.name';
   $q = "select * from  history where user_id='$us_id' ORDER BY time DESC";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        $status="success";
    }
    
    else
    {
    $status="failed";
    $data="No History for you";
    }  

$obj=array("status"=>$status,"msg"=>$data);
    echo json_encode($obj);
}


function get_time_slots()
{
    global $conn;
    $data=array();
   $q = "select * from  timeslots";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $row_data[] = $row;
        }
          $q1 = "select * from  app_setting";
    $result1 = mysqli_query($conn,$q1);
    $row1 = $result1->fetch_assoc();
    
        $data['responce']=true;
        $data['data']=$row_data;
        $data['min_amount']=$row1['w_amount'];
        $data['withdraw_limit']=$row1['withdraw_limit'];
        $data['w_saturday']=$row1['w_saturday'];
        $data['w_sunday']=$row1['w_sunday'];
    
    }
    
    else
    {
    $data['responce']=false;
    $data['message']="No time slots available";
    }  

    echo json_encode($data);
}

?>