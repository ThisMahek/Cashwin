<?php 
    $conn= mysqli_connect('localhost','anshuwap_projects_jannat', 'jannatmatka@123','anshuwap_jannat_matka');
    
   // $jsonArr = '[{"points":"[10, 10, 10, 10, 10]","digits":"[1, 3, 5, 7, 9]","bettype":"[0, 0, 0, 0, 1]","user_id":"2","matka_id":"2","date":"15/02/2001"}]';
    $jsonArr=$_POST['data'];
    if(empty( $jsonArr))
    {
        $status="failed1";
    } else {
        //[{"points":"[10, 10, 10, 10, 10]","digits":"[1, 3, 5, 7, 9]","bettype":"[Opening Bet, Opening Bet, Opening Bet, Opening Bet, Opening Bet]","user_id":"2","matka_id":"2","date":"15/02/2001"}]
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
                $bt = ($bettype[$i]==0)?"open":"close";
             $q="insert into tblodd_even (user_id,matka_id,points,digits,date,bet_type) values('$u', '$m', '$p', '$d', '$dx', '$bt');";
                        
                $dd = $conn->query($q);
                $i++;
            endforeach;        
        endforeach;
        
        	if ($dd === TRUE) {
        	    $status="success";
                $dt = array("status" => $status);
                echo json_encode($dt);
                return 1;
        	}
        	else
        	{
        	    $status="failed";
        	}
        
    }
     $dt = array("status" => $status);
     echo json_encode($dt);
    