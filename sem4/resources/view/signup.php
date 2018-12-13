<?php
$_SESSION['pageId'] = $_GET['page'];
use Util\Util;
?>

<div class="signup-container">
    <div class="signupform-header">
        <h2>Sign up <i class="fas fa-user-plus"></i></h2>
    </div>
    <div class="signupform-container">
        <form class="signup-form" action="signup_user.php" method="POST">
            <?php
                if(isset($username)){
                    echo '<div class="username-container">
                            <h3>Username <i class="far fa-user"></i></h3>
                            <input type="text" name="username" placeholder="Enter username" value="'.$username.'">
                            </div>';
                } else{
                    echo '<div class="username-container">
                            <h3>Username <i class="far fa-user"></i></h3>
                            <input type="text" name="username" placeholder="Enter username">
                            </div>';
                }
            ?>
            <div class="password-container">
                <h3>Password <i class="fas fa-key"></i></h3>
                <input type="password" name="password" placeholder="Enter password">
            </div>
            <div class="signbutton-container">
                <button type="submit" name="signupSubmit">Sign up</button>
            </div>
        </form>
        <?php  
            if(isset($signupStatus)){
                if($signupStatus == "fail"){
                    echo '<p class="error">'.$signupMessage.' <i class="fas fa-frown-open"></i></p>';
                } elseif($signupStatus == "success"){
                    echo '<p class="signup-success">Successfully signed up! <i class="fas fa-check-square"></i></p>';
                }
            }  
        ?>
        
    </div>
</div>