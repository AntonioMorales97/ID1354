<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

$controller = SessionManager::getController();
$username = $_POST['username'];
$commentMessage = htmlentities($_POST['comment'], ENT_QUOTES);
$recipeTitle = $_POST['recipe_title'];
$controller->setComment($username, $commentMessage, $recipeTitle);

?>