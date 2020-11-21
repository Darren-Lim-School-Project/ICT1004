<?php
session_start();
// Define and initialize variables to hold our form data:
$base64 = $caption = $errorMsg = "";
$success = true;
$_SESSION['acc_id'] = $acc_id;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $base64 = $_POST["b64"];
    $caption = $_POST["caption"];
    saveMemberToDB();
} else {
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='index.php'>Go to Sign up page...</a>";
    exit();
}

function GetToDB() {
    global $acc_id, $errorMsg, $success;
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
        $stmt = $conn->prepare("SELECT * in image where acc_id=?");
        
        // Bind & execute the query statement:
        $stmt->bind_param("s", $acc_id);
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
        <title>Image Upload Result</title>
        <?php
            include "../head.inc.php";
        ?>
        <meta http-equiv="refresh" content="5;url=../gui.php" />
    </head>
    <body>
        <?php
            include "../nav.inc.php";
        ?>
        <main class="container">
            
            <?php
            if ($success) {
                echo "<h3>Your image has been uploaded!</h3>";
                echo "<p>You will be redirected in 3 seconds...</h3>";
            } else {
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . $base64 ."</p>";
                echo "<a class=\"btn btn-danger\" href=\"../upload.php\">Return to Sign Up</a>";
            }
            ?>
            
        </main>
        <?php
            include "../footer.inc.php";
        ?>
    </body>
</html>