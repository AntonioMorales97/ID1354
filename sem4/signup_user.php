<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

if(isset($_POST['signupSubmit'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $username = htmlentities($_POST['username'], ENT_QUOTES);
            $password = htmlentities($_POST['password'], ENT_QUOTES);
            try{
                $controller = SessionManager::getController();
                $controller->registerNewUser($username, $password);
                $signupStatus = "success";

            }catch(CustomException $ex){
                $signupStatus = "fail";
                $signupMessage = "Username is already taken!";
            }catch(\mysqli_sql_exception $ex){
                echo '<script>alert("Something went wrong when connecting to the database. Please contact Antonio!")</script>';
            }finally{
                SessionManager::storeController($controller);
            }
        }else{
            $signupStatus = "fail";
            $signupMessage = "Please fill out every field!";
        }
    }
}
@$_GET['page'] = $_SESSION['pageId'];
include Util::VIEWS_PATH."redirect.php";
?>