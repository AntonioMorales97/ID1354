<?php
    session_start();
    //$_SESSION['currentURL'] = $_SERVER['REQUEST_URI']; //current url
    date_default_timezone_set('Europe/Stockholm'); //need JS for finding user location
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tasty Recipes</title>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/mainstyle.css">
    <link rel="stylesheet" href="css/homepagestyle.css">
    <link rel="stylesheet" href="css/signupstyle.css">
    <link rel="stylesheet" href="css/calendarstyle.css">
    <link rel="stylesheet" href="css/recipestyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- For fading out -->
</head>
<body>
    <div class="wrapper">
        <header>
            <nav>
                <?php
                    if(isset($_SESSION['username'])){
                        echo
                            '<ul class="loggedin-nav">
                                <form action="includes/logout_inc.php" method="POST">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="calendar.php">Calendar</a></li>
                                <li><button type="submit" name="submit"><span>Logout</span></button</li>
                                </form>
                            </ul>';
                    } else{
                        echo
                            '<ul class="loggedout-nav">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="calendar.php">Calendar</a></li>
                                <li><a onclick="document.getElementById(\'loginForm\').style.display=\'block\'">Login</a></li>
                                <li><a href="signup.php">Signup</a></li>
                            </ul>';
                    }
                ?>    
            </nav>
        </header>
        <div id="loginForm" class="login-container">
            <form class="login-content animate" action="includes/login_inc.php" method="POST">
                <div class="login-header-container">
                    <span onclick="document.getElementById('loginForm').style.display='none'" class="close" title="Close">&times;</span>
                    <i class="fas fa-user"></i>
                </div>
                <div class="loginform-container">
                    <label for="uname">Username</label>
                    <input type="text" placeholder="Enter Username" name="username" required="required">

                    <label for="psw">Password <i class="fas fa-key"></i></label>
                    <input type="password" placeholder="Enter Password" name="password" required="required">
                        
                    <button class="btn-login" type="submit" name="submit">Login</button>
                </div>
            </form>
        </div>

        <?php
            if(isset($_SESSION['login'])){
                /*
                if($_SESSION['login'] == 'false'){
                    echo 
                        '<div class="loginFail">
                            <p>Wrong username or password!</p>
                        </div>';
                    echo '<script>
                            $(document).ready(function(){
                            $(".loginFail").fadeOut(4000)   
                            });
                        </script>';
                    unset($_SESSION['login']);
                
                }
                */
                if($_SESSION['login'] == 'true'){
                    echo 
                        '<div class="loginSuccess">
                            <p>Login success!</p>
                        </div>';
                    echo '<script>
                            $(document).ready(function(){
                            $(".loginSuccess").fadeOut(3000)   
                            });
                        </script>';
                    unset($_SESSION['login']);
                }
            }
            
        ?>

        <script>
        // Get the login window
        var loginForm = document.getElementById('loginForm');

        //Close if the user clicks outside the window
        window.onclick = function(event) {
            if (event.target == loginForm) {
                loginForm.style.display = "none";
            }
        }
        </script>

    
    