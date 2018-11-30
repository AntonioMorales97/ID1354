<?php
use Controller\SessionManager;
use Util\Util;
use DTO\CommentDTO;
require_once 'classes/Util/Util.php';

$controller = \Controller\SessionManager::getController();
$comments = $controller->getComments($currentRecipe->title);

SessionManager::storeController($controller);
?>