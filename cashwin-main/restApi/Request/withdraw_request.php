<?php 
    $conn= mysqli_connect('localhost','chiragmatka_db', 'chiragmatka_db','chiragmatka_db');
    
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
    

     
    