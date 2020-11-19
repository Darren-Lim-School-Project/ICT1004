<?php
$servername = "localhost";
$username = "dev";
$password = "password";
$dbname = "SimpleGram";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["id"]. " - Name: ". $row["email"]. " " . $row["nickname"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>