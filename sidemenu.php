<!-- Sidebar/menu -->

<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container">


        <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
            <i class="fa fa-remove"></i>
        </a>
        <a href="gui.php"><img src="images/sp.jpg" alt="simplegram logo" style="width:100%;" class="w3-round"></a>
       
        <?php
        include "googletranslate.php";
        ?>
        <h4><b>Just a glance </b></h4>

    </div>
</div>
<div class="w3-bar-block">
    <a href="gui.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"c><i class=" fa fa-address-card-o fa-fw w3-margin-right"></i>My SimpleGram</a> 
    <a href="aboutUs.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw w3-margin-right"></i>About Simplegram</a> 
    <a href="contactUs.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-phone fa-fw w3-margin-right"></i>Contact</a>
    <a href="upload.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"c><i class=" fa fa-hand-o-up fa-fw w3-margin-right"></i>Upload Photo</a> 
    <a href="Myaccount.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"c><i class=" fas fa-eye fa-fw w3-margin-right"></i>My Account</a> 
</div>

</div>

</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
<script>
// Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
</script>