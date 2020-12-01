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
        include "css.php";
        ?>

    </head>
    <body class="w3-light-grey w3-content" style="max-width:1600px">
        <?php
        include "sidemenu.php";
        ?>

        <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </span>

        <!--side button-->
        <div class="w3-main" style="margin-left:300px">
            <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
                <div class="w3-content">
                    
                    <header>
                        <h1 class="w3-center mainheader">Upload Image</h1>
                    </header>
                    
                    <main class="di" >
                        <?php
                        if (isset($_SESSION['acc_id'])) {
                            echo '<form action="process/process_upload.php" class="sign-in-form" method="POST">';
                            echo '<label for="uploader">Select a file:</label>';
                            echo '<input type="file" id="uploader" accept=".jpg, .png, .jpeg">';

                            // Might change it to span method instead just to not be flagged by W3C HTML 5 Validator

                            echo '<input type="hidden" id="b64" name="b64" value=""/>';
                            echo '<button class="btn solid" type="submit">Upload</button>';
                            echo '</form>';
                        } else {
                            echo "<h2>This page is not meant to be run directly.</h2>";
                            echo "<p>You can login at the link below:</p>";
                            echo "<a href='index.php'>Go to Login page...</a>";
                        }
                        ?>
                    </main>
                    <?php
                    include "foot.inc.php";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
