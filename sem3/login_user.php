<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

echo Util::FADE_SCRIPT;

if(isset($_POST['username']) && isset($_POST['password'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $username = htmlentities($_POST['username'], ENT_QUOTES);
        $password = htmlentities($_POST['password'], ENT_QUOTES);
        try{
            $controller = SessionManager::getController();
            $controller->loginUser($username, $password);
            
            echo 
                '<div class="success">
                    <p>Login success!</p>
                </div>';
            echo 
                '<script>
                    $(document).ready(function(){
                    $(".success").fadeOut(3000)   
                    });
                </script>';
        }catch(CustomException $ex){
            echo '<script>alert("Username and password did not match!")</script>';
        }catch(\mysqli_sql_exception $ex){
            echo '<script>alert("Something went wrong when connecting to the database. Please contact Antonio!")</script>';
        }finally{
            SessionManager::storeController($controller);
        }
    }else{
        echo '<script>alert("Please fill out every field!")</script>';
    }
}
@$_GET['page'] = $_SESSION['pageId'];
include Util::VIEWS_PATH."redirect.php";
?>