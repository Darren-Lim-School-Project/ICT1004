<?php
session_start();
if (!isset($_SESSION['acc_id'])) { //if login in session is not set
    header("Location: http://34.207.30.147/SimpleGram/");
    exit();
}
?>

<!DOCTYPE html>
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

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:300px">
            <!-- Header -->
            <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()">
                <i class="fa fa-bars"></i>
            </span>
            <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
                <div class="w3-content">

                    <header>
                        <h1 class="w3-center mainheader"><b>About SimpleGram</b></h1>
                    </header>

                    <main>
                        <img class="w3-round w3-grayscale-min" src="images/sp.jpg" alt="SimpleGram Logo" style="width:100%;margin:32px 0">
                        <p>At SimpleGram, we believe in creating network between user-user, therefore we had made this gallery upload simple but yet catchy for the user to use.</p>
                        <p>No Requirement to add friend to view their profile, just search for your friend's name you can easily find their profile!</p>
                        <p>We would also like to bring back to those good old days whereby you might have asked your friend to "Leave a testimonial on my wall" when the social media called Friend**er was still around. Nostalgic huh?</p>
                    </main>

                </div>
                <?php
                include "foot.inc.php";
                ?>
                <!-- End page content -->
            </div>
        </div>
    </body>
</html>
