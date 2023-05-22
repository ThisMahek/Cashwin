<?php 
    $conn= mysqli_connect('localhost','anshuwap_projects_jannat', 'jannatmatka@123','anshuwap_jannat_matka');
    //echo $gpp="111-222";
    $q1="SELECT MAX(id) FROM tblgamedata"; 
                  $d2 = $conn->query($q1);
                  //echo $d2;
                  if($row=mysqli_fetch_array($d2,MYSQLI_BOTH))
                  {
                      $maxid=  $row[0];
                  }
                  $maxid=$maxid++;
//   $jsonArr = '[{"points":"[10, 10, 10, 10, 10]","digits":"[266-366, 266-366, 466-566, 666-766, 866-966]","bettype":"[0, 0, 0, 0, 1]","user_id":"2","matka_id":"2","date":"15/02/2001"}]';
  // $jsonArr = '[{"points":"[10, 10, 10, 10, 10]","digits":"[111, 266, 466, 666, 866]","bettype":"[112, 262, 462, 662, 8622]","user_id":"2","matka_id":"2","date":"15/02/2001","game_id":"2"}]';
 $jsonArr=$_POST['data'];
    if(empty( $jsonArr))
    {
        $status="failed1";
    } else {
        //[{"points":"[10, 10, 10, 10, 10]","digits":"[121-345, 3, 5, 7, 9]","bettype":"[Opening Bet, Opening Bet, Opening Bet, Opening Bet, Opening Bet]","user_id":"2","matka_id":"2","date":"15/02/2001"}]
        $json = json_decode($jsonArr);
         //print_r($json[0]->points);
        foreach($json as $js):
            $i = 0;
            $points = json_decode($js->points);
            $digits = json_decode($js->digits);
            $bettype = json_decode($js->bettype);
            foreach($points as $pa):
                $u = $js->user_id;
                $m = $js->matka_id;
                $p = $points[$i];
                $d = $digits[$i];
                $dx = $js->date;
                $bt = $bettype[$i];
                $gm= $js->game_id;
                
           $q="insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm');";
               //$q="insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm')";
             $dd = $conn->query($q);
                    $px="d";
                    // echo $gm;
                    $maxid++;
                    $qs="insert into history (user_id,matka_id,amt,digits,bid_id,date,type,game_id) values('$u', '$m', '$p', '$d','$maxid', '$dx', '$px','$gm')";
                    $dds = $conn->query($qs);

                
                
                
                $i++;
            endforeach;        
        endforeach;
        
           if($ponts>0)
            {
                $id = $u;
                $q1 = "select * from tblwallet where user_id = '$id'";
                $dd1 = $conn->query($q1);
                if(count($dd1)>0)
                    $q = "update tblwallet set wallet_points = wallet_points-'$ponts' where user_id = '$id'";
                else
                    $q = "insert into tblwallet (wallet_points, user_id) VALUES ('-$points', '$id')";
                $dd = $conn->query($q);
            }
        
        	if ($dds === TRUE) {
        	    $status="success";
                $dt = array("status" => $status);
                echo json_encode($dt);
                return 1;
        	}
        	else if($status==null)
        	{
        	    $status="failed";
        	}
        // 	else
        //         $status = $e." bids already ".$status;
    }
     $dt = array("status" => $status);
     echo json_encode($dt);