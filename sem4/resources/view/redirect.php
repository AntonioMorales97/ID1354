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
    <script type="text/javascript" src="resources/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="resources/js/knockout-3.4.2.js"></script>
    <script type="text/javascript" src="resources/js/tastyViewModel.js"></script>
</head>
<body>
    <div class="wrapper">
        <header>
            <nav>
                <!-- ko if: loggedIn-->
                <ul class="loggedin-nav"> 
                    <li><a href="index.php?page=home">Home</a></li>
                    <li><a href="index.php?page=calendar">Calendar</a></li>
                    <li><button data-bind="click: logout"><span>Logout</span></button></li>
                </ul>
                <!-- /ko -->
                <!-- ko ifnot: loggedIn-->
                <ul class="loggedout-nav">
                    <li><a href="index.php?page=home">Home</a></li>
                    <li><a href="index.php?page=calendar">Calendar</a></li>
                    <li><a data-bind="click: openLogin" >Login</a></li>
                    <li><a href="index.php?page=signup">Signup</a></li>
                </ul>
                <!-- /ko -->
            </nav>
        </header>
        
        <div id="loginForm" class="login-container" data-bind="visible: loginForm">
            <div class="login-content animate"> 
                <div class="login-header-container">
                    <span class="close" title="Close" data-bind="click: closeLogin">&times;</span>
                    <i class="fas fa-user"></i>
                </div>
                <div class="loginform-container">
                    <label for="uname">Username</label>
                    <input type="text" placeholder="Enter Username" data-bind="textInput: username">
                    <label for="psw">Password <i class="fas fa-key"></i></label>
                    <input type="password" placeholder="Enter Password" data-bind="textInput: password">        
                    <button class="btn-login" data-bind="click: login">Login</button>
                </div>
            </div>
        </div>
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
    <div id="message" data-bind="html: messageContent"></div>
</body>
</html>