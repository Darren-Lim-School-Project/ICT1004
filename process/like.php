<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $errorMsg, $success;
$imageId = "15";
$memberId = $_SESSION['acc_id'];

// Temp database connection
//$servername = "localhost";
//$username = "simplesqldev";
//$password = "password";
//$dbname = "SimpleGram";
//$conn = new mysqli($servername, $username, $password, $dbname);

// Create database connection.
$config = parse_ini_file('../../../private/dbconfig.ini');
$conn = new mysqli($config['servername'], $config['username'],
        $config['password'], $config['dbname']);

// Get count of likes
// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $sql = "SELECT COUNT(image_like_id) FROM image_like_by_member WHERE fk_image=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $imageId);
    $stmt->execute();
    $count = $stmt->get_result()->fetch_row()[0];

    if ($count == "0" || $count == "1") {
        $letterS = "";
    } else {
        $letterS = "s";
    }
}
$stmt->close();

// Check whether current user like status
// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $sql = "SELECT fk_member FROM image_like_by_member WHERE fk_image=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $imageId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_row()[0];

    if (empty($result)) {
        $likeClass = "like-border";
        $likeSrc = "images/baseline_favorite_border_18dp.png";
    } else {
        $likeClass = "like-black";
        $likeSrc = "images/baseline_favorite_black_18dp.png";
    }
}
$stmt->close();

if (isset($_GET['like'])) {
    likefunction();
}

// Trigger when liking or unlinking image
function likefunction() {
    if ($likeClass == "like-border") {
        $sql = "INSERT INTO image_like_by_member (fk_image, fk_member) VALUES ($imageId, $memberId)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->close();
    } else if ($likeClass == "like-black") {
        $sql = "DELETE FROM image_like_by_member WHERE fk_image=? AND fk_member=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $imageId, $memberId);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
?>