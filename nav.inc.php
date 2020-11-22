<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="userMain.php">
        <img src="images/Logo-Simplegram.png" alt="LOGO" width="200"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="upload.php">Upload</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gui.php"><?php echo $_SESSION['uname']; ?> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutUs.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>