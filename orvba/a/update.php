<?php
// update_status.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MECH_DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the ID from the POST request
$id = $_POST["id"];

// Update the row with the given ID
$sql = "UPDATE mech_edit SET status = 1 WHERE ID = " . $id;
if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
