<?php 
    $conn= mysqli_connect('localhost','chiragmatka_db', 'chiragmatka_db','chiragmatka_db');
	$user_id  = $_POST['user_id'];

//$user_id='122';
	
$result = mysqli_query($conn, "SELECT COUNT(*) as co FROM tblwallet where user_id='".$user_id."'") or die("some err");

$row=mysqli_fetch_assoc($result);
$cnt=$row['co'];

if($cnt==1)
{
  	$q="select * from tblwallet where user_id='$user_id'";
 	$result = mysqli_query($conn,$q);
	//header("location:usersdata.php"); 
		if(mysqli_num_rows($result)==1)
	{
	    $row1=mysqli_fetch_assoc($result);
	        
	}
	$status="success";
	$data=$row1;
//	echo json_encode($row1);


}
else
{
    $status="failed";
	$data=$cnt;
   
}
	$obj=array('status'=>$status,'message'=>$data);
echo json_encode($obj);
	

?>