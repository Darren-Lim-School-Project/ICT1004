<?php
session_start();
if (($_SESSION['admin']) == 1) { //if login in session is not set 
    ?>
    <html>
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
                            <h3 class="w3-center">EDIT COMMENT</h3>
                            <form method="post" target="_blank" action="4b-admin-ajax-comments.php">
                                <input type="hidden" name="req" value="edit"/>
                                <br>
                                Comment ID:<input type="number" name="comment_id" required/>
                                <br>
                                Name:<input type="text" name="name" required/>
                                <br>
                                Message:<input type="text" name="message" required/>
                                <br>
                                <input type="submit" class="btn btn-dark" value="Edit"/>
                            </form>

                            <h3 class="w3-center">DELETE COMMENT</h3>
                            <form method="post" target="_blank" action="4b-admin-ajax-comments.php">
                                <input type="hidden" name="req" value="del"/>
                                <br>
                                Comment ID:<input type="number" name="comment_id" required/>
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
    <html>
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
                            <h3 class="w3-center">I don't think you should be here...</h3>
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