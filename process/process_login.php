<?php
session_start();
// Define and initialize variables to hold our form data:
$acc_id = $fname = $lname = $email = $pwd_hashed = $errorMsg = "";
$success = true;

// Only process if the form has been submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Email address
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        
        // Additional check to make sure email address is well formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }
} else {
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<p>You can login at the link below:</p>";
    echo "<a href='login.php'>Go to Login page...</a>";
    exit();
}

    authenticateUser();

// Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/*
 * Helper function to authenticate the login.
 */
function authenticateUser() {
    global $acc_id, $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
    
    // Create database connection.
    $config = parse_ini_file('../../../private/dbconfig.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE email=?");
        
        // Bind & execute the query statement:
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Note that email field is unique, so should only have
            // one row in the result set.
            $row = $result->fetch_assoc();
            $acc_id = $row["acc_id"];
            $fname = $row["fname"];
            $lname = $row["lname"];
            $pwd_hashed = $row["password"];
            
            // Check if the password matches:
            if (!password_verify($_POST["pwd"], $pwd_hashed)) {
                // Don't be too specific with the error message - hackers don't
                // need to know which one they got right or wrong. :)
                $errorMsg = "Email not found or password doesn't match...";
                $success = false;
            } else {
                $_SESSION['acc_id'] = $acc_id;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
            }
        } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}?>
<html>
    <head>
        <title>Login Results</title>
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
                echo "<h3>Login successful!</h3>";
                echo "<h4>Welcome back, " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "</h4>";
                echo "<a class=\"btn btn-primary\" href=\"..\gui.php\">Return to home</a>";
            } else {
                echo "<h3>Oops!</h3>";
                echo "<h4>The following errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a class=\"btn btn-danger\" href=\"..\index.php\">Return to Login</a>";
            }
            ?>
            
        </main>
        <?php
            include "../footer.inc.php";
        ?>
    </body>
</html>