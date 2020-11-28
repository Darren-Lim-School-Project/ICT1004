<?php
/* [INIT] */
session_start();
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-comments.php";
$pdo = new Comments();

/* [HANDLE AJAX REQUESTS] */
switch ($_POST['req']) {
    /* [INVALID REQUEST] */
    default:
        echo "ERR";
        break;

    /* [SHOW COMMENTS] */
    case "show":
        $comments = $pdo->get($_POST['post_id']);
        function show($cid, $rid, $name, $time, $message, $accid, $indent = 0) {
            ?>
            <div class="ccomment<?= $indent ? " creply" : "" ?>">
                <div>
                    <span class="cname"><a href="./gui.php?id=<?=$accid ?>"><?= $name ?></a></span>
                    <span class="ctime"><?= $time ?></span>
                </div>
                <div class="cmessage"><?= $message ?></div>
                <input type="button" class="cbutton" value="Reply" onclick="comments.reply(<?= $cid ?>, <?= $rid ?>)"/>
                <div id="reply-<?= $cid ?>"></div>
            </div>
        <?php
        }

        if (is_array($comments)) {
            foreach ($comments as $c) {
                show($c['comment_id'], $c['comment_id'], $c['name'], $c['timestamp'], $c['message'], $c['commenter_id']);
                if (is_array($c['reply'])) {
                    foreach ($c['reply'] as $r) {
                        show($r['comment_id'], $c['comment_id'], $r['name'], $r['timestamp'], $r['message'], $r['commenter_id'], 1);
                    }
                }
            }
        }
        break;

    /* [SHOW REPLY FORM] */
    case "reply":
        if ($_SESSION['acc_id']) {
            ?>

            <form onsubmit="return comments.add(this)" class="creplyform">
                <h1>Add a comment</h1>
                <input type="hidden" name="reply_id" value="<?= $_POST['reply_id'] ?>"/>
                <input type="hidden" name="name" value="<?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname'] ?>" required/>
                <textarea name="message" placeholder="Message" required></textarea>
                <input type="submit" class="cbutton" value="Post Comment"/>
            </form>
        <?php
        } break;

    /* [ADD COMMENT] */
    case "add":
        if ($_SESSION['acc_id']) {
            echo $pdo->add($_POST['post_id'], $_POST['name'], $_POST['message'], $_SESSION['acc_id'], $_POST['reply_id']) ? "OK" : "ERR";
        } else {
            echo "ERR";
        }
        break;
}
?>