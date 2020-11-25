<?php
$config = parse_ini_file('../../../private/dbconfig.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        
    } else {
        if(isset($_REQUEST["term"])){
 
        // Prepare the statement:
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE  like ?");
        
        // Bind & execute the query statement:
        $stmt->bind_param("s", $parm_term);
        
        //set parameters
        $parm_term= $_REQUEST["term"].'%';
        $stmt->execute();
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
        }else{
           
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              //Fetch result rows as an array
               while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . $row["uname"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
                
            
        }
        
        $stmt->close();
        }
    }
    $conn->close();

?>
