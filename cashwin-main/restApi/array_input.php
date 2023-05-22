<?php

$s=$_POST['id'];
$a=str_split($s);
$v=implode($a,",");

echo $v;

?>