<!DOCTYPE html>


<html>

    <?php
    include "css.php";
    session_start();
    ?>

    <?php
    include "sidemenu.php";
    ?>

    <!-- !PAGE CONTENT! -->
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <!--side button-->
    <div class="w3-main" style="margin-left:300px">
        <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
            <div class="w3-content">
                <h1 class="w3-center w3-text-grey"><b>contact us </b></h1>



                <!-- Contact Section -->
                <form action="https://formspree.io/f/xpzolkro" id="test-form" method="POST">
                    <p>Lets get in touch. Send us a message:</p>
                    <form action="MailTo:stellayang23@hotmail.com"  method ="post" enctype="text/plain" target="_blank">
                        <p><input class="w3-input w3-padding-16 w3-border" type="text" value =  <?php echo $_SESSION['fname']; ?>  required name="Name"></p>



                        <p><input class="w3-input w3-padding-16 w3-border" type="text" value =  <?php echo $_SESSION['email']; ?> required name="Email"></p>
                        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Subject" required name="Subject"></p>
                        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Message" required name="Message"></p>
                        <p>
                            <!--              <button id="test-form-submit "class = "w3-button w3-light-grey w3-padding-large" type="submit">
                                            <i class="fa fa-paper-plane"></i> SEND MESSAGE
                                            
                                          </button>-->
                            <button type="submit" id="test-form-submit">Submit</button>
                            <script src="js/contactus.js"></script>


                        </p>
                    </form> 
            </div>


            <?php
            include "foot.inc.php";
            ?>
            <!-- End page content -->
        </div>


    </body>
</html>
