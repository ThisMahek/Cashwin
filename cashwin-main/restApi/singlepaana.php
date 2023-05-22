<?php
try{
	$dbh= new PDO('mysql:host=localhost;dbname=chiragmatka_db;charset=utf8','chiragmatka_db','chiragmatka_db');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$connection='connection successful';
     
	function testinput($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	
    $paana = testinput($_POST["paana"]);
    $points = testinput($_POST["points"]);
    $gametype = testinput($_POST["gametype"]);
    $bet= testinput($_POST["timedate"]);
    $matkaid = testinput($_POST["matkaid"]);
    $username = testinput($_POST["username"]);
    $q="INSERT into singlepaana (singlepaana,points,gametype,bet_datetime,matkaid,username) VALUES ('$paana', '$points', '$gametype','$bet','$matkaid','$username')";
if($dbh->exec($q)){
$status="success";
}
else{
$status="unsuccessful";
}
$obj=array('status'=>$status,'message'=>$connection);
echo json_encode($obj);
}
catch(PDOException $e)
{
	$connection=$e->getMessage();
	$status="unsuccessful";
	$obj=array('status'=>$status,'message'=>$connection);
    echo json_encode($obj);
	
}
?>