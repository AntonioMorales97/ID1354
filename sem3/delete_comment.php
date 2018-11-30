<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

if(isset($_POST['deleteComment'])){
    try{
        $controller = SessionManager::getController();

        $user_id = $_POST['user_id'];
        $comment_id = $_POST['comment_id'];
        $controller->deleteComment($user_id, $comment_id);
        echo '<script>alert("Comment deleted!")</script>';
    } catch(\mysqli_sql_exception $ex){
        echo '<script>alert("Something went wrong when connecting to the database. Please contact Antonio!")</script>';
    } finally{
        SessionManager::storeController($controller);
    }
}

@$_GET['page'] = $_SESSION['pageId'];
include Util::VIEWS_PATH."redirect.php";
?>