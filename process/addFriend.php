<?php
    session_start();
    $addfriend = $user_id ="";
    
    $addfriend = $_POST["add_friend_id"];
    $user_id = $_SESSION["id"];
    $success = true;

 


      if($addfriend == $user_id)
    {
        echo '<script type="text/javascript">alert("'.$user_id.'");</script>';
    }
// else {
//     function addFriend() {
//    
//    // Create database connection.
//    $config = parse_ini_file('../../../private/dbconfig.ini');
//    $conn = new mysqli($config['servername'], $config['username'],
//            $config['password'], $config['dbname']);
//    // Check connection
//    if ($conn->connect_error)
//    {
//        $errorMsg = "Connection failed: " . $conn->connect_error;
//       
//    } else {
//        
//                // Prepare the statement:
//        $stmt = $conn->prepare("SELECT * from user_Friends WHERE acc_id=?, friend_id=?");
//        $stmt->bind_param("ss", $user_id, $friend_id);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        if ($result->num_rows > 0) {
//        
//        echo "<script type='text/javascript'>alert('you are already friendds');</script>";
//        $addfriend = null;
//        
//        
//        } else{
//          
//         // Prepare the statement:
//         $stmt = $conn->prepare("INSERT INTO Friends (acc_id, friend_id) VALUES (?, ?)");
//         // Bind & execute the query statement:
//         $stmt->bind_param("ss", $_SESSION['acc_id'], $addFriend);
//         $stmt->execute();
//         echo "<script type='text/javascript'>alert('You are now friends');</script>";
//         $addfriend = null;
//        }
//        
//       $stmt->close(); 
//    
//    }
// }
//    $conn->close();
//        
//}  


?>