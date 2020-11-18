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

    </head>
    <body>

        <?php
        include "nav.inc.php";
        ?>

        <main class="container">
            
            <!--
            <canvas id="myCanvas" width="300" height="120"></canvas><br>
            <label for="btnUpload">Select an image file:</label>
            <input type="file" id="btnUpload" name="myfile" accept=".jpg, .png, .jpeg">
            -->
            
           <!-- <input id="inp" type="file" accept=".jpg, .png, .jpeg">
            <p id="resize"></p>
            <p id="b64"></p>  
            <img id="img" height="150">-->
            
            Select a file: <input type="file" id="uploader">
        <button onclick='resize()'>Resize</button>
        <img id="image">
            
        </main>

        <?php
        include "foot.inc.php";
        ?>

    </body>
</html>
