<?php
try{
	$dbh= new PDO('mysql:host=localhost;dbname=kingstarline_kingstarline;charset=utf8','kingstarline_kingstarline','kingstarline_kingstarline');
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$email=$_POST["email"];

$stmt=$dbh->query("SELECT mid FROM user_profile where email='$email'");
$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
if($results[0]["mid"]==""){
function getName() { 
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers='0123456789';
    
    $randomString = ''; 
  
    for ($i = 0; $i <3; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
    for ($i = 3; $i < 6; $i++) { 
        $index = rand(0, strlen($numbers) - 1); 
        $randomString .= $numbers[$index]; 
    } 
  
    return $randomString; 
} 
$mid=getname();

$q="update user_profile set mid='$mid' where email='$email'";
if($dbh->exec($q)){
$status="success";
}
else{
$status="unsuccessful";
}
$obj=array('status'=>$status,'ans'=>$mid);
echo json_encode($obj);
}
    else{
        $obj=array('status'=>"unsuccessful",'ans'=>"Mpin already exists");
echo json_encode($obj);
    }
}
catch(PDOException $e)
{
	$connection=$e->getMessage();
	$status="unsuccessful";
	$obj=array('status'=>$status,'ans'=>$connection);
    echo json_encode($obj);
	
}
?>