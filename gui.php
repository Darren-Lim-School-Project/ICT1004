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
    //$stmt = $conn->prepare("SELECT base64, caption FROM image");

    $stmt = $conn->prepare("SELECT i.base64, i.caption, a.fname, a.lname FROM image i, accounts a WHERE i.acc_id = a.acc_id");

    // Bind & execute the query statement:
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">  
    <head>
        <?php
        include "head.inc.php";
        include "css.php";
        ?>
        <script>
            $('#addFriend, .input').click(function () {
                $.post('process/add_friend.php',
                        {
                            "id": $(this).attr('id')
                        },
                        function (response) {

                            switch (response) {
                                case 'Already friends':
                                    $('#message_newfriend').html('<div id="alertFadeOut" style="color: green">Already friends!</div>');
                                    $('#alertFadeOut').fadeOut(3000, function () {
                                        $('#alertFadeOut').text('');
                                    });
                                    break;
                                case 'Trying to add themselves':
                                    $('#message_newfriend').html('<div id="alertFadeOut" style="color: red">You\'re trying to add yourself</div>');
                                    $('#alertFadeOut').fadeOut(3000, function () {
                                        $('#alertFadeOut').text('');
                                    });
                                    break;
                                case 'Added as friend':
                                    $('#message_newfriend').html('<div id="alertFadeOut" style="color: red">You\'re now friends!</div>');
                                    $('#alertFadeOut').fadeOut(3000, function () {
                                        $('#alertFadeOut').text('');
                                    });
                                    break;
                            }
                        });
            });
        </script>
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
                    <h1 class="w3-center w3-text-grey"><b>My Pictures</b></h1>
                    <br>
                    <div class="gallery">
                        <?php
                        $images = array();
                        $captions = array();
                        $fname = array();
                        $lname = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $images[] = $row["base64"];
                            $captions[] = $row["caption"];
                            $fname[] = $row["fname"];
                            $lname[] = $row["lname"];
                        }

                        $count = count($images);
                        ?>
                        <?php for ($i = 0; $i < $count;) { ?>
                            <!-- First Photo Grid-->
                            <div class="w3-row-padding">
                                <div class="w3-third w3-container w3-margin-bottom">
                                    <?php if ($images[$i] != null) { ?>
                                        <?php
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
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
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
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
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
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
                    </div>
                    <input type="button" id="" formmethod="post" value="Add as Friend">
                    <div id="message_newfriend"></div>

                    <?php
                    include "foot.inc.php";
                    ?>
                    <!-- End page content -->
                </div>
            </div>
        </div>
    </body>
</html>
