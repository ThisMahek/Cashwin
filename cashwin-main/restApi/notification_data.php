<?php 
$conn= mysqli_connect('localhost','kingstarline_kingstarline', 'kingstarline_kingstarline','kingstarline_kingstarline');

$sql = "SELECT starting_num,number,end_num FROM matka WHERE updated_at LIKE '2019-07-01%'";
//WHERE CONVERT(VARCHAR(25), updated_at, 126) LIKE '2009-10-10%'
//$result = $conn->query($sql);
$result=mysqli_query($conn,$sql);

//$sql = "SELECT *  FROM tblgamedata where  date = 'current date'";
//$result = $conn->query($sql);

 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo json_encode($row);
    }
    
 }
 else
 {
     $data="0";
 
 }




?>