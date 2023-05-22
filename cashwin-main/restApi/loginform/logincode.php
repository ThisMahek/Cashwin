<?php
    include("connect.php");
    if(isset($_POST['username'])){
        	$uname=$_POST['username'];
        	$password=$_POST['password'];
        
        $sql="select * from login where User='".$uname."'";
        $result=mysqli_query($conn,$sql);
        
        if($row= mysqli_fetch_array($result,MYSQLI_BOTH)){
        	if($row['Pass']==$password){
//        	    if($row['Pass']=='1')
        		    echo "login success";
        // 		else
        // 		    echo "already logged in.";
        	}
        }
        else
            echo "Failed";
    }