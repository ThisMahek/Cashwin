<?php 
    $conn= mysqli_connect('localhost','chiragmatka_db', 'chiragmatka_db','chiragmatka_db');
    $us_id=$_POST['user_id'];
    // $us_id=866;
   
   $q="select * from tblRequest where user_id='$us_id' ORDER BY time DESC";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
    }
    else
    {
        $data="empty";
    }
    
    echo json_encode($data);
    ?>