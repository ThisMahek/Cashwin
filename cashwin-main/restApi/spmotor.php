<?php

//$arr=$_POST["arr"];
$s=$_POST["arr"];
$a=str_split($s);
$arr=implode($a,",");

$numArray=explode(",",$arr);
$arr = array_map('intval', $numArray);
//print_r( $arr);
$data=array(array(137,128,146,236,245,290),
array(380,470,489,560,678,579),
//array(119,155,227,335,344,399),
//array(588,669,777,100),
array(129,138,147,156,237,246),
array(345,390,480,570,589,679),
//array(110,228,255,336,499,660),
//array(688,778,200,444),
array(120,139,148,157,238,247),
array(256,346,490,580,670,689),
//array(166,229,337,355,445,599),
//array(779,788,300,111),
array(130,149,158,167,239,248),
array(257,347,356,590,680,789),
//array(112,220,266,338,446,455),
//array(699,770,400,888),
array(140,159,168,230,249,258),
array(267,348,357,456,690,780),
//array(113,122,177,339,366,447),
//array(799,889,500,555),
array(123,150,169,178,240,259),
array(268,349,358,367,457,790),
//array(114,277,330,448,466,556),
//array(880,899,600,222),
array(124,160,179,250,269,278),
array(340,359,368,458,467,890),
//array(115,133,188,223,377,449),
//array(557,566,700,999),
array(125,134,170,189,260,279),
array(350,369,378,459,468,567),
//array(116,224,233,288,440,477),
//array(558,990,800,666),
array(126,135,180,234,270,289),
array(360,379,450,469,478,568),
//array(117,144,199,225,388,559),
//array(577,667,900,333),
array(127,136,145,190,235,280),
array(370,389,460,479,569,578),
//array(118,226,244,299,334,488),
//array(668,677,000,550)
);
$a=0;
$b=0;
$a=0;
$k=0;
$t=0;
$m=array();
$final=array();

for($i=0;$i<count($data);$i++){
    for($j=0;$j<count($data[$i]);$j++){
        $k=0;
        $b=0;
        $num=$data[$i][$j];
        while($num!=0){
            $d=$num%10;
            $b++;
            if($b<4){
                if(!(in_array($d,$arr,false)))
                {
                    $k=1;
                    break;
                }
            }
            $num=(int)$num/10;
        }
        if($k==0)
        $m[$a++]=$data[$i][$j];
        
      //              echo $m;
        
        //print_r($m);
        
    }
}
for($i=0;$i<count($m);$i++){
 $b=0;
 $c=0;
 $num=$m[$i];
 while($num!=0){
     $d=$num%10;
     $arr2[$b++]=$d;
     $num=(int)$num/10;
    
//    echo $d;
 }
//  for($j=0;$j<2;$j++){
//      if($arr2[$j]<=$arr2[($j)+1]){
//          $c=1;
//          break;
//      }
//  }
//  if($c==0){
     $final[$t++]=$m[$i];
// }
}
echo json_encode(array("status" => "success", "data" => $final));

?>

