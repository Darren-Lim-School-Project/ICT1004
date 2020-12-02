<!DOCTYPE html>

<?php
session_start();
require '/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php';
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

        <!-- !PAGE CONTENT! -->
        <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </span>

        <!--side button-->
        <div class="w3-main" style="margin-left:300px">
            <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
                <div class="w3-content">

                    <header>
                        <h1 class="w3-center mainheader"><b>Contact us</b></h1>
                    </header>

                    <main>
                        <!-- Contact Section -->
                        <form action="MailTo:simplegram@hotmail.com"  method ="post" enctype="text/plain" target="_blank">
                            <p>Lets get in touch. Send us a message:</p>
                           
                                <p>
                                    <label for="contactus_fname">Name:</label>
                                    <input class="w3-input w3-padding-16 w3-border" type="text" id="contactus_fname" value="<?php echo $_SESSION['fname']; ?>" name="Name" required>
                                </p>

                                <p>
                                    <label for="contactus_email">Email:</label>
                                    <input class="w3-input w3-padding-16 w3-border" type="text" id="contactus_email" value="<?php echo $_SESSION['email']; ?>" name="Email" required>
                                </p>

                                <p>
                                    <label for="contactus_subject">Subject:</label>
                                    <input class="w3-input w3-padding-16 w3-border" type="text" id="contactus_subject" placeholder="Subject" required name="Subject">
                                </p>

                                <p>
                                    <label for="contactus_message">Message:</label>
                                    <textarea class="w3-input w3-padding-16 w3-border" name="contactus_message" id="contactus_message" placeholder="Message" required></textarea>
                                </p>
                                
                                <p>
                                    <button type="submit" id="test-form-submit" class="contactUsBtn">Submit</button>
                                    <script src="js/contactus.js"></script>
                                </p>
                            </form> 
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
