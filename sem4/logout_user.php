<?php
namespace View;

use \Util\Util;

require_once 'classes/Util/Util.php';
Util::initRequest();

session_regenerate_id();
session_unset();
session_destroy();

?>