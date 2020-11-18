<?php
// Define and initialize variables to hold our form data:
$base64 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $base64 = $_POST["b64"];
    saveMemberToDB();
    
} else {
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='index.php'>Go to Sign up page...</a>";
    exit();
}

function saveMemberToDB() {
    global $base64;
    
    // Create database connection.
    $config = parse_ini_file('../../../private/dbconfig.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $conn->prepare("INSERT INTO image (base64) VALUES (?)");
        
        // Bind & execute the query statement:
        $stmt->bind_param("s", $base64);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<html>
    <head>
        <title>Registration Results</title>
        <?php
            include "../head.inc.php";
        ?>
    </head>
    <body>
        <?php
            include "../nav.inc.php";
        ?>
        
        <main class="container">
            
            <?php
            if ($success) {
                echo "<h3>Your registration is successful!</h3>";
                echo "<h4>Thank you for signing up, " . $fname . " " . $lname . "</h4>";
                echo "<a class=\"btn btn-primary\" href=\"index.php\">Log-in</a>";
            } else {
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . $base64 . "</p>";
                echo "<a class=\"btn btn-danger\" href=\"upload.php\">Return to Sign Up</a>";
            }
            ?>
            
        </main>
        <?php
            include "../footer.inc.php";
        ?>
    </body>
</html>