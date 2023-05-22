<?php
$conn= mysqli_connect('localhost','anshuwap_projects_jannat', 'jannatmatka@123','anshuwap_jannat_matka');
$servername = "localhost";
$username = "projects_jannat";
$password = "jannatmatka@123";
$dbname = "projects_jannat_matka";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error );
} 

?>