<?php
    $digit = $_REQUEST["search"];
    $type = $_REQUEST["type"];
    $number = array();

    function count_pana($num_i, $num_j, $num_k) {
        $c = 1;
        if((int)$num_i==(int)$num_j) $c++;
        if((int)$num_i==(int)$num_k) $c++;
        if((int)$num_j==(int)$num_k) $c++;
        return $c;
    }

    if($digit==0)
        $digit = 10;
    if($type!="dp")
        $type = "sp";
    //$i = $digit;
    for($i=1; $i<=$digit; $i++):
        for($j=$i; $j<=10; $j++):
            for($k=$j; $k<=10; $k++):
                if($i==10) $num_i = 0; else $num_i = $i;
                if($j==10) $num_j = 0; else $num_j = $j;
                if($k==10) $num_k = 0; else $num_k = $k;
                if((($type=="sp" && count_pana($num_i, $num_j, $num_k)==1) || ($type=="dp" && count_pana($num_i, $num_j, $num_k)!=1)) && ($digit==$i || $digit==$j ||  $digit==$k))
                    $number[] = $num_i.$num_j.$num_k;
            endfor;
        endfor;
    endfor;
    
    //echo json_encode($data);
    if(!empty($number))
        $status="success";
    else
        $status="unsuccessful";
    $obj=array('status'=>$status,'answer'=>$number);
    echo json_encode($obj);
?>