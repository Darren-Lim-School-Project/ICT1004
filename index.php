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
        <main class="logreg-container">
            <div class="forms-container">
                <div class="signin-signup">
                    <form action="process/process_login.php" class="sign-in-form" method="POST">
                        <h2 class="title">Sign in</h2>
                        
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" aria-label="Enter your email here to log in your account." 
                                   id="email" name="email" placeholder="Email" required>
                        </div>
                        
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" aria-label="Enter your password here to log in your account." 
                                   id="pwd" name="pwd" placeholder="Password" required>
                        </div>
                        
                        <button class="btn solid" type="submit">Login</button>
                        
                        <p class="social-text">Or Sign in with social platforms</p>
                        <div class="social-media">
                            
                            <a href="#" aria-label="Login with Facebook" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            
                            <a href="#" aria-label="Login with Google" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            
                        </div>
                    </form>
                    <form action="process/process_register.php" class="sign-up-form" method="POST">
                        <h2 class="title">Sign up</h2>
                        
                        <div class="input-field">
                            
                            <i class="fas fa-envelope"></i>
                            <input type="email" aria-label="Enter your email here to create an account." 
                                   id="email" name="email" placeholder="Email" required>
                            
                        </div>
                        
                        <div class="input-field">
                            
                            <i class="fas fa-user"></i>
                            <input type="text" aria-label="Enter your first name to create an account." 
                                   id="fname" name="fname" placeholder="First Name" required>
                            
                        </div>
                        
                        <div class="input-field">
                            
                            <i class="fas fa-user"></i>
                            <input type="text" aria-label="Enter your last name to create an account." 
                                   id="lname" name="lname" placeholder="Last Name" required>
                            
                        </div>
                        
                        <div class="input-field">
                            
                            <i class="fas fa-lock"></i>
                            <input type="password" aria-label="Enter your password here to create an account." 
                                   id="pwd" name="pwd" placeholder="Password" required>
                            
                        </div>
                        
                        <div class="input-field">
                            
                            <i class="fas fa-lock"></i>
                            <input type="password" aria-label="Re-enter your password to confirm your password" 
                                   id="pwd_confirm" name="pwd_confirm" placeholder="Confirm Password" required>
                            
                        </div>
                        <button class="btn" type="submit">Sign up</button>
                        <p class="social-text">Or Sign up with social platforms</p>
                        <div class="social-media">
                            <a href="#" aria-label="Sign up with Facebook" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" aria-label="Sign up with Google" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>New here?</h3>
                        <p>
                            Create an account here!
                        </p>
                        <button class="btn transparent" id="sign-up-btn">
                            Sign up
                        </button>
                    </div>
                    <img src="img/log.svg" class="image" alt="" />
                </div>
                <div class="panel right-panel">
                    <div class="content">
                        <h3>One of us?</h3>
                        <p>
                            Have an account? Sign in here!
                        </p>
                        <button class="btn transparent" id="sign-in-btn">
                            Sign in
                        </button>
                    </div>
                    <img src="img/register.svg" class="image" alt="" />
                </div>
            </div>
        </main>

        <?php
        include "foot.inc.php";
        ?>
        
    </body>
</html>
