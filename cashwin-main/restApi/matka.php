<?php 
    $conn= mysqli_connect('localhost','rdgames_newdatabase', 'rdgames_newdatabase','rdgames_newdatabase');

    $q = "select * from matka ORDER BY matka_order";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
       $i=0;
        while($row = $result->fetch_assoc()) {
           $data[$i]= $row;
           $i++;
        }
    } else {
        $data = "0";
    }
    
    echo json_encode($data);
?>