<?php 
    $conn= mysqli_connect('localhost','kingstarline_kingstarline', 'kingstarline_kingstarline','kingstarline_kingstarline');
    
    $points = $_POST['points'];
    $id= $_POST['user_id'];
    $q1 = "select * from tblwallet where user_id = '$id'" ;
    $dd1 = $conn->query($q1);
    if(count($dd1)>0)
        $q = "update tblwallet set wallet_points = '$points' where user_id = '$id'";
    else
        $q = "insert into tblwallet (wallet_points, user_id) VALUES ('$points', '$id')";
    $dd = $conn->query($q);
    if ($dd === TRUE) {
        	    $status="success";
                $dt = array("status" => $status);
                echo json_encode($dt);
                //return 1;
        	}
        	else
        	{
        	    $status="failed";
        	     $dt = array("status" => $status);
                echo json_encode($dt);
                //return 1;
        	}
    
    ?>