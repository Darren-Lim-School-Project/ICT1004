<?php
$addfriend = $_POST["id"];
$user_id = $_SESSION["id"];

function addFriend() {
    global $addFriend, $user_id, $errorMsg, $success;
    
    if($addFriend==$user_id)
    {
        echo 'Trying to add themselves';
    }
 else {
        
    // Create database connection.
    $config = parse_ini_file('../../../private/dbconfig.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
       
    } else {
        
                // Prepare the statement:
        $stmt = $conn->prepare("SELECT * from user_Friends WHERE acc_id=?, friend_id=?");
        $stmt->bind_param("ss", $user_id, $friend_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
        
        // Prepare the statement:
        echo 'Already friends';
        
        } else{
          
         // Prepare the statement:
         $stmt = $conn->prepare("INSERT INTO Friends (acc_id, friend_id) VALUES (?, ?)");
         // Bind & execute the query statement:
         $stmt->bind_param("ss", $_SESSION['acc_id'], $addFriend);
         $stmt->execute();
         echo 'Added as friend';
        }
        
       $stmt->close(); 
    
    }
 }
    $conn->close();
}
?>
