<?php 
    $conn= mysqli_connect('localhost','smartmatka_smartmatka', 'smartmatka_smartmatka','smartmatka_smartmatka');
    $us_id=$_POST['id'];
 //$us_id=14;
    //Odd Even Data
    // $odd_even = 'tblgamedata.id,tblgamedata.user_id,tblgamedata.matka_id,tblgamedata.points,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.digits,tblgamedata.game_id,matka.name';
    //$odd_even = 'tblodd_even.id,tblodd_even.user_id,tblodd_even.matka_id,tblodd_even.points,tblodd_even.bet_type,tblodd_even.date,tblodd_even.time,tblodd_even.digits,matka.name';
    $q = "select * from  matka where id=$us_id ";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $status="success";
          $data = $row;
        }
    }
    else
    {
          $status="success";
          $data[] = "0";
    }
    
    // //Single Digit
    // $single_digit = 'tblsingledigit.id,tblsingledigit.user_id,tblsingledigit.matka_id,tblsingledigit.points,tblsingledigit.bet_type,tblsingledigit.date,tblsingledigit.time,tblsingledigit.digits,matka.name';
    // $q1="select ".$single_digit." from  tblsingledigit JOIN matka ON matka.id=tblsingledigit.matka_id";
    // $result1 = mysqli_query($conn,$q1);
    // if ($result1->num_rows > 0) {
    //     while($row1 = $result1->fetch_assoc()) {
    //       $data[] = $row1;
    //     }
    // }
//echo json_encode(array("status" => "success", "data" => $final));
$obj=array("status"=>$status, "data"=>$data);
    echo json_encode($obj);
    