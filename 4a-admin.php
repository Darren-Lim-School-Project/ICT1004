<?php
session_start();
if (($_SESSION['admin']) == 1) { //if login in session is not set 
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <?php
            include "head.inc.php";
            include "css.php";
            include "server.php";
            ?>
        </head>
        <body class="w3-light-grey w3-content" style="max-width:1600px">
            <?php
            include "sidemenu.php";
            ?>

            <!-- !PAGE CONTENT! -->
            <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>

            <div class="w3-main" style="margin-left:300px">
                <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
                    <div class="w3-content">
                        <header>
                            <h1 class="w3-center mainheader">
                                <b>Comments Admin Page</b>
                            </h1>
                        </header>
                        <br>
                        <main>
                            <h2 class="w3-center">EDIT COMMENT</h2>
                            <form method="post" target="_blank" action="4b-admin-ajax-comments.php">
                                <input type="hidden" name="req" value="edit"/>
                                <br>
                                <label for="comment_id">Comment ID:</label>
                                <input type="number" name="comment_id" aria-label="Enter the comment ID" required/>
                                <br>
                                <label for="name">Name:</label>
                                <input type="text" name="name" aria-label="Enter the name of the user" required/>
                                <br>
                                <label for="message">Message:</label>
                                <input type="text" name="message" id="message" aria-label="Enter the message"  required/>
                                <br>
                                <input type="submit" class="btn btn-dark" value="Edit"/>
                            </form>

                            <h2 class="w3-center">DELETE COMMENT</h2>
                            <form method="post" target="_blank" action="4b-admin-ajax-comments.php">
                                <input type="hidden" name="req" value="del"/>
                                <br>
                                <label for="dcomment_id">Comment ID:</label>
                                <input type="number" name="comment_id" id="dcomment_id" aria-label="Enter the comment ID"  required/>
                                <br>
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                            <br>
                        </main>
                        <?php
                        include "foot.inc.php";
                        ?>
                        <!-- End page content -->
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <?php
            include "head.inc.php";
            include "css.php";
            include "server.php";
            ?>
        </head>
        <body class="w3-light-grey w3-content" style="max-width:1600px">
            <?php
            include "sidemenu.php";
            ?>

            <!-- !PAGE CONTENT! -->
            <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>

            <div class="w3-main" style="margin-left:300px">
                <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
                    <div class="w3-content">
                        <header>
                            <h1 class="w3-center mainheader">
                                <b>Comments Admin Page</b>
                            </h1>
                        </header>
                        <br>
                        <main>
                            <img src="images/holup.gif" alt="Hold Up" id="holup">
                            <h2 class="w3-center">I don't think you should be here...</h2>
                            <br>
                        </main>
                        <?php
                        include "foot.inc.php";
                        ?>
                        <!-- End page content -->
                    </div>
                </div>
            </div>
        </body>
    </html>
<?php } ?>