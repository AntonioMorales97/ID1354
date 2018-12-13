<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \DTO\CommentDTO;

require_once 'classes/Util/Util.php';
Util::initRequest();

$controller = SessionManager::getController();
$comments = $controller->getComments($_POST['currentRecipe']);
SessionManager::storeController($controller);

echo json_encode($comments);
?>