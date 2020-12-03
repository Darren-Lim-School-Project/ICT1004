<?php
session_start();
if(!isset($_SESSION['acc_id'])){ //if login in session is not set
    header("Location: http://34.207.30.147/SimpleGram/");
    exit();
}

$urlId = $_GET['id'];
$config = parse_ini_file('../../private/dbconfig.ini');
$conn = new mysqli($config['servername'], $config['username'],
        $config['password'], $config['dbname']);
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    // Prepare the statement:
    //$stmt = $conn->prepare("SELECT image_id, base64, caption FROM image WHERE acc_id=?");
    $stmt = $conn->prepare("SELECT i.base64, i.caption, a.fname, a.lname, i.upload_date FROM image i, accounts a WHERE a.acc_id=? AND i.acc_id = a.acc_id ORDER BY i.upload_date DESC");
    $stmt->bind_param("s", $urlId);
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
        include "server.php";
        ?>
        <style>
            p {
                text-align: center;
            }

            .img1{
                width: 100%;
            }

        </style>
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
                        <b>My Pictures</b>
                    </h1>
                    </header>
                    <br>
                    <main>
                    <div class="gallery">
                        <?php
                        $images = array();
                        $captions = array();
                        $fname = array();
                        $lname = array();
                        $postId = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $images[] = $row["base64"];
                            $captions[] = $row["caption"];
                            $fname[] = $row["fname"];
                            $lname[] = $row["lname"];
                            $postId[] = $row["image_id"];
                        }
                        $count = count($images);
                        ?>
                        <?php for ($i = 0; $i < $count;) { ?>
                            <!-- First Photo Grid-->
                            <div class="w3-row-padding">
                                <div class="w3-third w3-container w3-margin-bottom">
                                    <?php if ($images[$i] != null) { ?>
                                        <?php
                                        echo "<img class='img1' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
                                        ?>
                                        <div class="w3-container w3-white">
                                            <?php
                                            echo "<p><b>" . $captions[$i] . "</b></p>";
                                            ?>
                                            <div class="post-info">
                                                <!-- If user likes post, style button differently -->
                                                <i <?php if (userLiked($postId[$i])): ?>
                                                        class="fa fa-thumbs-up like-btn"
                                                    <?php else: ?>
                                                        class="fa fa-thumbs-o-up like-btn"
                                                    <?php endif ?>
                                                    data-id="<?php echo $postId[$i] ?>"></i>
                                                <span class="likes"><?php echo getLikes($postId[$i]); ?></span>

                                                &nbsp;&nbsp;&nbsp;&nbsp;

                                                <!-- If user dislikes post, style button differently -->
                                                <i <?php if (userDisliked($postId[$i])): ?>
                                                        class="fa fa-thumbs-down dislike-btn"
                                                    <?php else: ?>
                                                        class="fa fa-thumbs-o-down dislike-btn"
                                                    <?php endif ?>
                                                    data-id="<?php echo $postId[$i] ?>"></i>
                                                <span class="dislikes"><?php echo getDislikes($postId[$i]); ?></span>
                                            </div>
                                            <?php
                                            $i++;
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="w3-third w3-container w3-margin-bottom">
                                    <?php if ($images[$i] != null) { ?>
                                        <?php
                                        echo "<img class='img1' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
                                        ?>
                                        <div class="w3-container w3-white">
                                            <?php
                                            echo "<p><b>" . $captions[$i] . "</b></p>";
                                            ?>
                                            <div class="post-info">
                                                <!-- if user likes post, style button differently -->
                                                <i <?php if (userLiked($postId[$i])): ?>
                                                        class="fa fa-thumbs-up like-btn"
                                                    <?php else: ?>
                                                        class="fa fa-thumbs-o-up like-btn"
                                                    <?php endif ?>
                                                    data-id="<?php echo $postId[$i] ?>"></i>
                                                <span class="likes"><?php echo getLikes($postId[$i]); ?></span>

                                                &nbsp;&nbsp;&nbsp;&nbsp;

                                                <!-- if user dislikes post, style button differently -->
                                                <i <?php if (userDisliked($postId[$i])): ?>
                                                        class="fa fa-thumbs-down dislike-btn"
                                                    <?php else: ?>
                                                        class="fa fa-thumbs-o-down dislike-btn"
                                                    <?php endif ?>
                                                    data-id="<?php echo $postId[$i] ?>"></i>
                                                <span class="dislikes"><?php echo getDislikes($postId[$i]); ?></span>
                                            </div>
                                            <?php
                                            $i++;
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="w3-third w3-container">
                                    <?php if ($images[$i] != null) { ?>
                                        <?php
                                        echo "<img class='img1' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
                                        ?>
                                        <div class="w3-container w3-white">
                                            <?php
                                            echo "<p><b>" . $captions[$i] . "</b></p>";
                                            ?>
                                            <div class="post-info">
                                                <!-- if user likes post, style button differently -->
                                                <i <?php if (userLiked($postId[$i])): ?>
                                                        class="fa fa-thumbs-up like-btn"
                                                    <?php else: ?>
                                                        class="fa fa-thumbs-o-up like-btn"
                                                    <?php endif ?>
                                                    data-id="<?php echo $postId[$i] ?>"></i>
                                                <span class="likes"><?php echo getLikes($postId[$i]); ?></span>

                                                &nbsp;&nbsp;&nbsp;&nbsp;

                                                <!-- if user dislikes post, style button differently -->
                                                <i <?php if (userDisliked($postId[$i])): ?>
                                                        class="fa fa-thumbs-down dislike-btn"
                                                    <?php else: ?>
                                                        class="fa fa-thumbs-o-down dislike-btn"
                                                    <?php endif ?>
                                                    data-id="<?php echo $postId[$i] ?>"></i>
                                                <span class="dislikes"><?php echo getDislikes($postId[$i]); ?></span>
                                            </div>
                                            <?php
                                            $i++;
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!--<form action="process/addFriend.php" method="POST">
                        <button class="btn" name="addFriend" type="submit">Add Friend</button>
                        <input type="hidden" name="add_friend_id" value="<?php echo $urlId; ?>">
                    </form>-->

                    <script src="public/3b-comments.js"></script>
                    <div id="commentSection">
                        <br>
                        <br>
                        <input type="hidden" id="post_id" value="<?php echo $_GET['id'] ?>"/>
                        <div id="comments"></div>
                        <div id="reply-main"></div>
                    </div>
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
