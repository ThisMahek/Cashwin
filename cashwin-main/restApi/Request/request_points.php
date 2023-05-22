<?php 
    $conn= mysqli_connect('localhost','rdgames_newdatabase', 'rdgames_newdatabase','rdgames_newdatabase');
    
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
    

     
    