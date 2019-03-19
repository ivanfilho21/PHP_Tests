<?php
require ROOT_PATH . "/config/config.php";
require ROOT_PATH . "/config/main.php";

require ROOT_PATH . "/class/auth/Authentication.php";
require ROOT_PATH . "/class/Util.php";

#global $util, $auth;

$util = new Util();
$auth = new Authentication($dbAdmin);
$user = $auth->getLoggedUser();