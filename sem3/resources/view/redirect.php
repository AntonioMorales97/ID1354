<?php 
header("Cache-Control: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tasty Recipes</title>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="resources/css/reset.css">
    <link rel="stylesheet" href="resources/css/mainstyle.css">
    <link rel="stylesheet" href="resources/css/homepagestyle.css">
    <link rel="stylesheet" href="resources/css/signupstyle.css">
    <link rel="stylesheet" href="resources/css/calendarstyle.css">
    <link rel="stylesheet" href="resources/css/recipestyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <header>
            <nav>
                <?php
                    if(isset($_SESSION['username'])){
                        echo
                            '<ul class="loggedin-nav">
                                <form action="logout_user.php" method="POST">
                                <li><a href="index.php?page=home">Home</a></li>
                                <li><a href="index.php?page=calendar">Calendar</a></li>
                                <li><button type="submit" name="submit"><span>Logout</span></button></li>
                                </form>
                            </ul>';
                    } else{
                        echo
                            '<ul class="loggedout-nav">
                                <li><a href="index.php?page=home">Home</a></li>
                                <li><a href="index.php?page=calendar">Calendar</a></li>
                                <li><a onclick="document.getElementById(\'loginForm\').style.display=\'block\'">Login</a></li>
                                <li><a href="index.php?page=signup">Signup</a></li>
                            </ul>';
                    }
                ?>    
            </nav>
        </header>

        <div id="loginForm" class="login-container">
            <form class="login-content animate" action="login_user.php" method="POST">
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

        <?php 
        $mainPage = isset($_GET['page']) ? $_GET['page']: "home";
        $mainPages = array(
            'home' => ''.Util\Util::VIEWS_PATH.'home.php',
            'calendar' => ''.Util\Util::VIEWS_PATH.'calendar.php',
            'Glazed Meatballs' => ''.Util\Util::VIEWS_PATH.'recipe.php',
            'Swedish Pancakes' => ''.Util\Util::VIEWS_PATH.'recipe.php',
            'signup' => ''.Util\Util::VIEWS_PATH.'signup.php'
        );
        include_once(isset($mainPages[$mainPage]) ? $mainPages[$mainPage]:$mainPages["home"]);
        ?>

        <footer>
            <p>Course ID1354 &copy; 2018</p>
        </footer>
    <!-- Wrapper ends -->
    </div>
</body>
</html>