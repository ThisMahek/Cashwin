<?php 
    $conn= mysqli_connect('localhost','chiragmatka_db', 'chiragmatka_db','chiragmatka_db');
    $us_id=$_POST['us_id'];
    $matka_id=$_POST['matka_id'];
    //  $us_id='2';
    // $matka_id=15;
    // //Odd Even Data
    
     $play_for="play_for";
          $play_on="play_on";
          $day="day";
if($matka_id<14)
{
 
     $odd_even = 'tblgamedata.id,tblgamedata.user_id,tblgamedata.matka_id,tblgamedata.points,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.digits,tblgamedata.game_id,tblgamedata.status,matka.name ';
    //$odd_even = 'tblodd_even.id,tblodd_even.user_id,tblodd_even.matka_id,tblodd_even.points,tblodd_even.bet_type,tblodd_even.date,tblodd_even.time,tblodd_even.digits,matka.name';
   $q = "select ".$odd_even." from  tblgamedata JOIN matka ON matka.id=tblgamedata.matka_id where tblgamedata.user_id=$us_id and tblgamedata.matka_id=$matka_id ORDER BY time DESC";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          
          $x['play_for']=$play_for;
          $x['play_on']=$play_on;
          $x['day']=$day;
         $r = array_merge($row, $x);
         $data[] = $r;
        }
    }
    else
    {
        $data="empty";
    }  
}
else
{
    $d="select tblgamedata.id,tblgamedata.user_id,tblgamedata.matka_id,tblgamedata.points,tblgamedata.bet_type,tblgamedata.date,tblgamedata.time,tblgamedata.digits,tblgamedata.game_id,tblgamedata.status,tblStarline.s_game_time from tblgamedata,tblStarline where  tblgamedata.user_id=$us_id AND tblgamedata.matka_id=tblStarline.id AND matka_id>'15' ORDER BY time DESC";
     $result1 = mysqli_query($conn,$d);
    if ($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) {
          
           $x['play_for']=$play_for;
          $x['play_on']=$play_on;
          $x['day']=$day;
          $r = array_merge($row1,$x);
          $data[] = $r;
        }
    }
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
  
//print_r($r);
    echo json_encode($data);
    ?>