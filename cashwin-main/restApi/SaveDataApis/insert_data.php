<?php 
    $conn= mysqli_connect('localhost','chiragmatka_db', 'chiragmatka_db','chiragmatka_db');
    $q1="SELECT MAX(id) FROM tblgamedata";
    $d2 = $conn->query($q1);
    if($row=mysqli_fetch_array($d2,MYSQLI_BOTH))
        $maxid=  $row[0]++;
    $jsonArr=$_POST['data'];
    if(empty( $jsonArr))
        $status="failed1";
    else {
        //[{"points":"[10, 10, 10, 10, 10]","digits":"[121-345, 3, 5, 7, 9]","bettype":"[Opening Bet, Opening Bet, Opening Bet, Opening Bet, Opening Bet]","user_id":"2","matka_id":"2","date":"15/02/2001"}]
        $json = json_decode($jsonArr);
        foreach($json as $js):
            $ponts = $i = $e = 0;
            $points = json_decode($js->points);
            $digits = json_decode($js->digits);
            $bettype = json_decode($js->bettype);

            $u = $js->user_id;
            $m = $js->matka_id;
            $dx = $js->date;
            $gm= $js->game_id;
            $q1 = "select * from matka where id = '$m'";
            $dd = $conn->query($q1);
            $st = (date('D')==='Sat')?'sat_start_time':((date('D')==='Sun')?'start_time':'bid_start_time');
            $et = (date('D')==='Sat')?'sat_end_time':((date('D')==='Sun')?'end_time':'bid_end_time');
            if($row1=mysqli_fetch_array($d2,MYSQLI_BOTH)) {
                // $stime = $row1[$st];
                // $etime = $row1[$et];
                $time = ($bettype[$i]==0)?$row1[$st]:$row1[$et];
                if((time() >= strtotime($time)) || (strtotime(date('Y-m-d')) < strtotime($dx))):
                    
                    $q2 = "select * from tblwallet where user_id = '$u'";
                    $dd1 = $conn->query($q2);
                    if(count($dd1)>0):
                        $wallet_amt = $dd1->wallet_points;
                        foreach($points as $pa):
                            $p = $points[$i];
                            $wallet_amt = $wallet_amt-$p;
                            if($wallet_amt>=0):
                                $ponts += $p;
                                $d = (string)$digits[$i];
                                $bt = ($bettype[$i]==0)?"open":"close";
                                
                                $q="insert into tblgamedata (user_id,matka_id,points,digits,date,bet_type,game_id) values('$u', '$m', '$p', '$d', '$dx', '$bt','$gm')";
                                $dd = $conn->query($q);
                                $maxid++;
                                $qs="insert into history (user_id,matka_id,amt,digits,bid_id,date,type,game_id) values('$u', '$m', '$p', '$d','$maxid', 'd', '$px','$gm')";
                                $dds = $conn->query($qs);
                                $i++;
                            endif;
                        endforeach;
                    endif;
                else:
                    $status="timeout";
                endif;
            }
        if($ponts>0)
        {
            if(count($dd1)>0)
                $q = "update tblwallet set wallet_points = wallet_points-'$ponts' where user_id = '$id'";
            else
                $q = "insert into tblwallet (wallet_points, user_id) VALUES (0, '$id')";
            $dd = $conn->query($q);
        }            
        endforeach;

    	if (($dds === TRUE) || ($status!="timeout")) {
    	    $status="success";
            $dt = array("status" => $status);
            echo json_encode($dt);
            return 1;
    	}
    	else if($status==null)
    	{
    	    $status="failed";
    // 	} else
    //         $status = $e." bids already ".$status;
        }
    }
    $dt = array("status" => $status);
    echo json_encode($dt);