<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

$status = "";
if(isset($_POST['username']) && isset($_POST['password'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $username = htmlentities($_POST['username'], ENT_QUOTES);
        $password = htmlentities($_POST['password'], ENT_QUOTES);
        try{
            $controller = SessionManager::getController();
            $controller->loginUserProcess($username, $password);
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $status = "success";
        }catch(CustomException $ex){
            $status = "fail";
        }catch(\mysqli_sql_exception $ex){
            $status = "error";
        }finally{
            SessionManager::storeController($controller);
        }
    }else{
        $status = "empty";
    }
}
echo $status;
?>