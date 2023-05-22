<?php 
    $conn= mysqli_connect('localhost','kingstarline_kingstarline', 'kingstarline_kingstarline','kingstarline_kingstarline');
   
    //Odd Even Data
    
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
         
    
    ?>