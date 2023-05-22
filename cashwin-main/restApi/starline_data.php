<?php 
    $conn= mysqli_connect('localhost','chiragmatka_db', 'chiragmatka_db','chiragmatka_db');
    
    $id=$_POST['id'];
    
    $q = "select * from tblStarline where id=$id";
    $result = mysqli_query($conn,$q);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo json_encode($row);
        }
    }
    else
    {
        echo json_encode("0");
    }
    
    
   
    ?>