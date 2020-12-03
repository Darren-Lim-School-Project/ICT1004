<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
if (!isset($_SESSION['acc_id'])) { //if login in session is not set
    header("Location: http://34.207.30.147/SimpleGram/");
    exit();
}
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
                        <form action="process/process_upload.php" class="sign-in-form" method="POST">
                            <label for="uploader">Select a file:</label>
                            <input type="file" id="uploader" accept=".jpg, .png, .jpeg">
                            <input type="hidden" id="b64" name="b64" value=""/>
                            <button class="contactUsBtn" id="uploadBtn" type="submit">Upload</button>
                        </form>
                    </main>
                    <?php
                    include "foot.inc.php";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
