<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

echo Util::FADE_SCRIPT;

if(isset($_POST['commentSubmit'])){
    if(!empty($_POST['comment'])){
        $commentMessage = htmlentities($_POST['comment'], ENT_QUOTES); //Secure against XSS
        try{
            $controller = SessionManager::getController();

            $controller->setComment($_SESSION['username'], $commentMessage, $_POST['recipe_title']);
            echo 
                '<div class="success">
                    <p>Comment was successfully posted!</p>
                </div>';
            echo 
                '<script>
                    $(document).ready(function(){
                    $(".success").fadeOut(3000)   
                    });
                </script>';
        } catch(\mysqli_sql_exception $ex){
            echo '<script>alert("Something went wrong when connecting to the database. Please contact Antonio!")</script>';
        } finally{
            SessionManager::storeController($controller);
        }
    }else{
        echo '<script>alert("No empty comments are allowed!")</script>';
    }
}

@$_GET['page'] = $_SESSION['pageId'];
include Util::VIEWS_PATH."redirect.php";
?>