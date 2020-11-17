<!DOCTYPE html>
<html>   
    
    <?php
            include "sidemenu.php";
        ?>
    
<?php
include "css.php";
?>



<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px"> 

    <!-- Header -->
    <header id="portfolio">
        <div class="w3-container">
            <h1><b>My Portfolio</b></h1>
            <!--Date time-->
            <p>Date/Time: <span id="datetime"></span></p><script>var dt = new Date();
                document.getElementById("datetime").innerHTML = dt.toLocaleString();</script>    

        </div>
    </header>

    <!-- First Photo Grid-->
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

    <!-- Second Photo Grid-->
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

    <!-- Pagination -->
    <?php
    include "mainpaging.php";
    ?>
    <!


    <?php
    include "foot.inc.php";
    ?>
    <!-- End page content -->
</div>


</body>
</html>
