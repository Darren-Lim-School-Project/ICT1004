<?php
    session_start();
?>

<!DOCTYPE html>
<html>   
    <script>
    $('#addFriend, .input').click(function() {
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


    <?php
    include "css.php";
    ?>

    <?php
    include "sidemenu.php";
    ?>

    <!-- !PAGE CONTENT! -->
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>

    <div class="w3-main" style="margin-left:300px">
        <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
            <div class="w3-content">
                <h1 class="w3-center w3-text-grey"><b>My Pictures</b></h1>

                
                <div class="gallery">
                    <?php
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
                        if ($result->num_rows > 0) {
                            // Note that email field is unique, so should only have
                            // one row in the result set.
                            while ($row = $result->fetch_assoc()) {
                                $imageBase64 = $row["base64"];
                                ?>
                                <img src="data:image/png;base64,<?php echo $imageBase64; ?>" alt=""/>
                    <?php
                            }
                        }
                        $stmt->close();
                    }
                    ?>
                </div>
                <input type="button" id="" formmethod="post" value="Add as Friend">
                <div id="message_newfriend"></div>
                <!-- First Photo Grid-->
                <!--
                <div class="w3-row-padding">
                    <div class="w3-third w3-container w3-margin-bottom">
                        <img src="/w3images/mountains.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Lorem Ipsum</b></p>
                            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                        </div>
                    </div>
                    <div class="w3-third w3-container w3-margin-bottom">
                        <img src="/w3images/lights.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Lorem Ipsum</b></p>
                            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                        </div>
                    </div>
                    <div class="w3-third w3-container">
                        <img src="/w3images/nature.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Lorem Ipsum</b></p>
                            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                        </div>
                    </div>
                </div>
                -->

                <!-- Second Photo Grid-->
                <!--
                <div class="w3-row-padding">
                    <div class="w3-third w3-container w3-margin-bottom">
                        <img src="/w3images/p1.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Lorem Ipsum</b></p>
                            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                        </div>
                    </div>
                    <div class="w3-third w3-container w3-margin-bottom">
                        <img src="/w3images/p2.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Lorem Ipsum</b></p>
                            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                        </div>
                    </div>
                    <div class="w3-third w3-container">
                        <img src="/w3images/p3.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Lorem Ipsum</b></p>
                            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                        </div>
                    </div>
                </div>
                -->

                <!-- Pagination -->

                <!


                <?php
                include "foot.inc.php";
                ?>
                <!-- End page content -->
            </div>


            </body>
            </html>
