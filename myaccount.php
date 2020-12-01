<?php
session_start();

$conn = new mysqli('localhost', 'simplesqldev', 'password', 'SimpleGram');

//$config = parse_ini_file('../../private/dbconfig.ini');
//$conn = new mysqli($config['servername'], $config['username'],
//        $config['password'], $config['dbname']);
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    // Prepare the statement:
    $stmt = $conn->prepare("SELECT * FROM image WHERE acc_id=?");

    // Bind & execute the query statement:
    $stmt->bind_param("s", $_SESSION['acc_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">  
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <?php
        include "head.inc.php";
        include "css.php";
        ?>
        <style>
            p {
                text-align: center;
            }
            .btn-warning, .btn-warning:hover {
                background-color: #dc3545;
            }
        </style>
        <script>
            $(document).ready(function () {
                $(".btn-warning").click(function () {
                    var image_id = $(this).attr("id");
                    $.ajax({
                        type: "POST",
                        url: "process/process_delete_image.php",
                        data: {
                            "image_id": image_id
                        },
                        success: function (data) {
                            var dataResult = JSON.parse(data);
                            if (dataResult.statusCode == 200) {
                                location.reload();
                            } else {
                                console.log("Deletion error!");
                            }
                        }
                    });
                });
            });
        </script>
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

                    <header>
                        <h1 class="w3-center mainheader"><b>My Account</b></h1>
                    </header>

                    <main>

                        <section>
                            <form action="process/process_edit.php" class="sign-in-form" method="POST">
                                <table>
                                    <tr>
                                        <td>
                                            <label for="edit_pwd">Old Password:</label>
                                        </td>
                                        <td>
                                            <input type="password" aria-label="Enter your old password." 
                                                   id="edit_pwd" name="edit_pwd">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="edit_npwd">New Password:</label>
                                        </td>
                                        <td>
                                            <input type="password" aria-label="Enter your new password." 
                                                   id="edit_npwd" name="edit_npwd">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label for="edit_cpwd">Confirm New Password:</label>
                                        </td>
                                        <td>
                                            <input type="password" aria-label="Confirm your new password." 
                                                   id="edit_cpwd" name="edit_cpwd">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning" type="submit">Save</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </section>

                        <hr />

                        <section>
                            <div class="gallery">
                                <?php
                                //Two array for storing picture and captions 
                                $images = array();
                                $captions = array();
                                $image_ids = array();
                                $fname = array();
                                $lname = array();
                                // fetch from data base

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $images[] = $row["base64"];
                                    $captions[] = $row["caption"];
                                    $image_ids[] = $row["image_id"];
                                    $fname[] = $row["fname"];
                                    $lname[] = $row["lname"];
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
                                                echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
                                                ?> 
                                                <div class="w3-container w3-white">
                                                    <?php
                                                    echo "<p><b>" . $captions[$i] . "</b></p>";
                                                    echo '<div class="row justify-content-center">';
                                                    echo '<button id="' . $image_ids[$i] . '" class="btn btn-warning">Delete</button>';
                                                    echo "</div>";
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
                                                    echo '<div class="row justify-content-center">';
                                                    echo '<button id="' . $image_ids[$i] . '" class="btn btn-warning">Delete</button>';
                                                    echo "</div>";
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
                                                    echo '<div class="row justify-content-center">';
                                                    echo '<button id="' . $image_ids[$i] . '" class="btn btn-warning">Delete</button>';
                                                    echo "</div>";
                                                    $i++;
                                                    ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </section>
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
