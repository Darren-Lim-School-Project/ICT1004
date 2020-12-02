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
    $stmt = $conn->prepare("SELECT image_id, base64, caption FROM image");
    //$stmt = $conn->prepare("SELECT i.base64, i.caption, a.fname, a.lname, i.upload_date FROM image i, accounts a WHERE i.acc_id = a.acc_id ORDER BY i.upload_date DESC");
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
                    <h1 class="w3-center w3-text-grey"><b>Explore Simplegram</b></h1>
                    <br>
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
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
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
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
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
                                        echo "<img style='width:100%' src='data:image/png;base64," . $images[$i] . "' alt='Image by " . $fname[$i] . " " . $lname[$i] . "'>";
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
                        <input type="hidden" id="post_id" value="999"/>
                        <div id="comments"></div>
                        <div id="reply-main"></div>
                    </div>
                    <?php
                    include "foot.inc.php";
                    ?>
                    <!-- End page content -->
                </div>
            </div>
        </div>
    </body>
</html>