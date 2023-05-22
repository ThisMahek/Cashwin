<?php 
$conn= mysqli_connect('localhost','chiragmatka_db', 'chiragmatka_db','chiragmatka_db');
  $us_id=$_POST['us_id'];
//    $us_id=10;

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
    $data[]="No History for you";
    }  

$obj=array("status"=>$status,"msg"=>$data);
    echo json_encode($obj);
    ?>