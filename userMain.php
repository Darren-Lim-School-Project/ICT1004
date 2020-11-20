<?php
session_start()
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <!-- 
    Declare lang attribute not only declare the language of web page, it can also assist search engines and browser
    -->
    <head>
        <?php
        include "head.inc.php";
        ?>
        <script defer 
                src="js/main.js">
        </script> 
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <header class="jumbotron text-center">
            <?php echo "<h1>" . $_SESSION['fname'] . " " . $_SESSION['lname'] . "</h1>"; ?>
        </header>
        <main class="container">
            <?php
            include "process/like.php";
            ?>
            <input type="image" id="like" name="like" class="<?php echo $likeClass; ?>" src="<?php echo $likeSrc; ?>" alt="Like" style="outline:none" onclick="toggle()"/>
            <?php echo "<h3>Like" . $letterS . ": "  . $count . "</h3>"; ?>
            <?php echo "<p>" . $errorMsg . "</p>"; ?>
        </main>
        <?php
        include "foot.inc.php";
        ?>
    </body>
</html>