<?php
// Define and initialize variables to hold our form data:
$fname = $lname = $email = $pwd_hashed = $errorMsg = "";
$success = true;

// Only process if the form has been submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // First Name
    if (!empty($_POST["fname"])) {
        $fname = sanitize_input($_POST["fname"]);
    }
    
    // Last Name
    if (empty($_POST["lname"])) {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } else {
        $lname = sanitize_input($_POST["lname"]);
    }
    
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
    
    // Password
    if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"])) {
        $errorMsg .= "Password and confirmation are required.<br>";
        $success = false;
    } else {
        // Make sure password match
        if ($_POST["pwd"] != $_POST["pwd_confirm"]) {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        } else {
            // NOTE: We do not sanitize the password since this could strip out characters
            // That are meant to be part of the password. Instead, we will hash the password
            // Before storing it in our database, and NEVER output the plaintext password to the web page
            $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        }
    }
    
    saveMemberToDB();
    
} else {
    echo "<h2>This page is not meant to be run directly.</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='index.php'>Go to Sign up page...</a>";
    exit();
}



// Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function saveMemberToDB() {
    global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
    
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
        $stmt = $conn->prepare("INSERT INTO accounts (email, password, fname, lname) VALUES (?, ?, ?, ?)");
        
        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $email, $pwd_hashed, $fname, $lname);
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
                echo "<p>" . $errorMsg . "</p>";
                echo "<a class=\"btn btn-danger\" href=\"index.php\">Return to Sign Up</a>";
            }
            ?>
            
        </main>
        <?php
            include "../footer.inc.php";
        ?>
    </body>
</html>