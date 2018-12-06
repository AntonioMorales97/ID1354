<?php
namespace View;

use \Util\Util;

require_once 'classes/Util/Util.php';
Util::initRequest();

@$_GET['page'] = $_SESSION['pageId']; //before destroying sessions

session_regenerate_id();
session_unset();
session_destroy();

include Util::VIEWS_PATH."redirect.php";
?>