<?php
//$conn= mysqli_connect('localhost','projects_jannat', 'jannatmatka@123','projects_jannat_matka');
$servername = "localhost";
$username = "kingstarline_kingstarline";
$password = "kingstarline_kingstarline";
$dbname = "kingstarline_kingstarline";
//'localhost','projects_jannat', 'jannatmatka@123','projects_jannat_matka'

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error );
} 
else
{
    echo "suceesss";
}

?>