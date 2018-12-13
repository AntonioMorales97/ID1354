<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \DTO\CommentDTO;

require_once 'classes/Util/Util.php';
Util::initRequest();

$controller = SessionManager::getController();
$username = $controller->getUsername($_POST['user_id']);
SessionManager::storeController($controller);
echo $username;

?>