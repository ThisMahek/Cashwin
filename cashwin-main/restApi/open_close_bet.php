<?php
    $conn= mysqli_connect('localhost','kingstarline_kingstarline', 'kingstarline_kingstarline','kingstarline_kingstarline');
    $mt_id=$_POST['matka_id'];
    //$mt_id=11;
    
    $sl="select * from matka where id='$mt_id'";
     $result = mysqli_query($conn,$sl);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
    }
    
    echo json_encode($data);
    
?>