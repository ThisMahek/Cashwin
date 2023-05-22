<?php
$data=array(array(11,16,61,66),
array(12,21,17,71,26,62,67,76),
array(13,31,18,81,36,63,68,86),
array(14,41,19,91,46,64,69,96),
array(15,51,10,1,56,65,60,6),
array(22,27,72,77),
array(23,32,28,82,37,73,78,87),
array(24,42,29,92,47,74,79,97),
array(25,52,20,2,57,75,70,7),
array(33,38,83,88),
array(34,43,39,93,48,84,89,98),
array(35,53,30,3,58,85,80,8),
array(44,49,94,99),
array(45,54,40,4,59,95,90,9),
array(55,50,5,0),
);


$search=$_POST["search"];
$k=0;
for($i=0;$i<count($data);$i++){
    for($j=0;$j<count($data[$i]);$j++){
        if($search==$data[$i][$j]){
        $index=$i;
        $k=1;
        break;
        }
    }
    
}
if($k==1)
$status="success";
else
$status="unsuccessful";
$ans=$data[$index];
$obj=array('status'=>$status,'answer'=>$ans);
echo json_encode($obj);
?>