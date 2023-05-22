<?php 
$conn= mysqli_connect('localhost','kingstarline_kingstarline', 'kingstarline_kingstarline','kingstarline_kingstarline');

$sql = "SELECT * FROM tblgamedata WHERE matka_id = 6";
//$result = $conn->query($sql);
$result=mysqli_query($conn,$sql);

//$sql = "SELECT *  FROM tblgamedata where  date = 'current date'";
//$result = $conn->query($sql);

 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $data[]=$row;
    }
    
 }
 else
 {
     $data="0";
 
 }
 echo json_encode($data);



?>