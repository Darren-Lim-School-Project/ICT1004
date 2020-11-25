<?php
session_start();

$config = parse_ini_file('../../private/dbconfig.ini');
$conn = new mysqli($config['servername'], $config['username'],
        $config['password'], $config['dbname']);
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    // Prepare the statement:
    $stmt = $conn->prepare("SELECT base64, caption FROM image WHERE acc_id=?");

    // Bind & execute the query statement:
    $stmt->bind_param("s", $_SESSION['acc_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>  
    <head>
        <?php
        include "head.inc.php";
        ?>
        <?php
        include "css.php";
        ?>
        <style>
            p {
                text-align: center;
            }
        </style>
       
    </head>
    <body>
        <?php
        include "sidemenu.php";
        ?>

        <!-- !PAGE CONTENT! -->
        <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>

        <div class="w3-main" style="margin-left:300px">
            <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
                <div class="w3-content">
                    <h1 class="w3-center w3-text-grey"><b>My Pictures</b></h1>
                    <br>
                    <div class="gallery">
                        <?php
                        //Two array for storing picture and captions 
                        $images = array();
                        $captions = array();
                        // fetch from data base
  
                        while ($row = mysqli_fetch_assoc($result)) {
                            $images[] = $row["base64"];
                            $captions[] = $row["caption"];
                        }
                       // connect to dbs
                        $count = count($images);
                        ?> 
                         <!-- Create a loop for the counting the things inserted-->
                        <?php for ($i = 0; $i < $count;) { ?>
                           <!--set 3 rows to put image  -->
                            <div class="w3-row-padding">
                                <div class="w3-third w3-container w3-margin-bottom">
                                    <?php if ($images[$i] != null) { ?> <!--if there is image will fetch from db -->
                                        <?php
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' >"; 
                                        ?> 
                                        <div class="w3-container w3-white">
                                            <?php
                                            echo "<p><b>" . $captions[$i] . "</b></p>";
                                            $i++;
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="w3-third w3-container w3-margin-bottom">
                                    <?php if ($images[$i] != null) { ?>
                                        <?php
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' >";
                                        ?>
                                        <div class="w3-container w3-white">
                                            <?php
                                            echo "<p><b>" . $captions[$i] . "</b></p>";
                                            $i++;
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="w3-third w3-container">
                                    <?php if ($images[$i] != null) { ?>
                                        <?php
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' >";
                                        ?>
                                        <div class="w3-container w3-white">
                                            <?php
                                            echo "<p><b>" . $captions[$i] . "</b></p>";
                                            $i++;
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
               
                    <?php
                    include "foot.inc.php";
                    ?>
                    <!-- End page content -->
                </div>
            </div>
        </div>
    </body>
</html>
