<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;

require_once 'classes/Util/Util.php';
Util::initRequest();
$controller = SessionManager::getController();
@$_GET['page'] = $_SESSION['pageId']; //before destroying sessions
$controller->logoutUser();
SessionManager::storeController($controller);

include Util::VIEWS_PATH."redirect.php";
?>