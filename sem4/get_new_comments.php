<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \DTO\CommentDTO;

require_once 'classes/Util/Util.php';
Util::initRequest();


set_time_limit(0);

$controller = SessionManager::getController();
$currentMaxCommentID = $_POST['currentMaxCommentID'];
$recipe_title = $_POST['recipe_title'];
while(true){
    $latestCommentID = $controller->getLatestCommentID($recipe_title);
    if($latestCommentID > $currentMaxCommentID){
        $latestComment = $controller->getComment($latestCommentID);
        SessionManager::storeController($controller);
        echo json_encode($latestComment);
        exit;
    }
    session_write_close();
    sleep(2); //db queries are heavy
    session_start();
}



?>