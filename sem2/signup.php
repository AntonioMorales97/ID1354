<?php
    include_once 'fragments/header.php';
?>

<div class="signup-container">
    <div class="signupform-header">
        <h2>Sign up <i class="fas fa-user-plus"></i></h2>
    </div>
    <div class="signupform-container">
        <form class="signup-form" action="includes/signup_inc.php" method="POST">
            <?php
                if(isset($_GET['username'])){
                    $username = $_GET['username'];
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
                <button type="submit" name="submit">Sign up</button>
            </div>
        </form>
        <?php
            if(!isset($_GET['signup'])){
                exit();
            } else{
                $signupMessage = $_GET['signup'];

                if($signupMessage == "empty"){
                    echo '<p class="error">You did not fill in all fields! <i class="fas fa-frown-open"></i></p>';
                    exit();
                } elseif($signupMessage == "usertaken"){
                    echo '<p class="error">Username is already taken! <i class="fas fa-frown-open"></i></p>';
                    exit();
                } elseif($signupMessage == "success"){
                    echo '<p class="signup-success">Successfully signed up! <i class="fas fa-check-square"></i></p>';
                    exit();
                }
            }
            
            
        ?>
        
    </div>
</div>
<?php
    include_once 'fragments/footer.php';
?>

