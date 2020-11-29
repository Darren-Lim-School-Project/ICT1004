<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Create connection
$conn = new mysqli('localhost', 'simplesqldev', 'password', 'SimpleGram');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$image_id = $_POST["image_id"];
// sql to delete a record
$sql = "DELETE FROM image WHERE image_id=$image_id";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode"=>200));
} else {
    echo json_encode(array("statusCode"=>201));
}

$conn->close();
?>