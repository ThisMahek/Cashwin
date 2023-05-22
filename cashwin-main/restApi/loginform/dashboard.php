<?php
include("connect.php");
$sql = "SELECT * FROM register";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Dashboard</h2>


<table>
  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Fathername</th>
    <th>phonenumber</th>
    <th>password</th>
  </tr>

 
    <?php
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?> 
  <tr>
    <td><?php echo $row["Firstname"]?></td>
    <td><?php echo $row["Lastname"]?></td>
    <td><?php echo $row["Fathername"]?></td>
    <td><?php echo $row["phonenumber"]?></td>
    <td><?php echo $row["password"]?></td>
  </tr>
  <?php
}}?>
</table>
</body>
</html>
