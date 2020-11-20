<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
    session_start();
?>

<html lang="en">
    <head>

        <?php
        include "head.inc.php";
        include "view_images";
        ?>

    </head>
    <body>

        <?php
        include "nav.inc.php";
        ?>
        
        <main class="container">
            
        <?php
        if (isset($_SESSION['acc_id'])) {
            echo '<form action="process/process_upload.php" class="sign-in-form" method="POST">';
            echo '<label for="uploader">Select a file:</label>';
            echo '<input type="file" id="uploader" accept=".jpg, .png, .jpeg">';
            echo '<img id="image">';
            echo '<input type="hidden" id="b64" name="b64" value=""/>';
            echo '<button class="btn solid" type="submit">Upload</button>';
            echo '<label>View all Images</label>';
            echo '<button class="btn solid" type="submit">View</button>';
            echo '</form>';
            echo '<ui id="Viewimages">';
            
            
            echo'</ui>';
        } else {
            echo "<h2>This page is not meant to be run directly.</h2>";
            echo "<p>You can login at the link below:</p>";
            echo "<a href='login.php'>Go to Login page...</a>";
        }
        ?>

        </main>
        
<?php
include "foot.inc.php";
?>

    </body>
</html>
