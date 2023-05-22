<?php
try{
	$dbh= new PDO('mysql:host=localhost;dbname=kingstarline_kingstarline;charset=utf8','kingstarline_kingstarline','kingstarline_kingstarline');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$connection='connection successful';
     
	function testinput($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	$id = testinput($_POST["id"]);
    $digits = testinput($_POST["digits"]);
    $points = testinput($_POST["points"]);
    $gametype = testinput($_POST["gametype"]);
    $bet= testinput($_POST["timedate"]);
    $matkaid = testinput($_POST["matkaid"]);
    $username = testinput($_POST["username"]);
    $q="INSERT into doubledigit(doubledigit,points,gametype,bet_datetime,matkaid,username) VALUES ('$digits', '$points', '$gametype','$bet','$matkaid','$username')";
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