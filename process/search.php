<?php
$config = parse_ini_file('../../../private/dbconfig.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        
    } else {
        if(isset($_POST["query"])){
        $query=$_POST["query"];
        // Prepare the statement:
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE uname like '$query%'");
        
        // Bind & execute the query statement:
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
        }else{
           
            if($result->num_rows > 0){
              //Fetch result rows as an array
               while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo $row["uname"]."<br/>";
                }
            } else{
                echo "<p>No matches found </p>";
                echo '<script>console.log('.$query.'</script>';
            }
                
            
        }
        
        $stmt->close();
        }
    }
    $conn->close();

?>
