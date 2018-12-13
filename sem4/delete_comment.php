<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();


$controller = SessionManager::getController();
$user_id = $_POST['user_id'];
$comment_id = $_POST['comment_id'];
$controller->deleteComment($user_id, $comment_id);
SessionManager::storeController($controller);

?>