<?php

require dirname(__FILE__) . "/config/config.php";
require dirname(__FILE__) . "/class/database/dao/DAO.php";
require dirname(__FILE__) . "/class/database/DatabaseAdmin.php";
require dirname(__FILE__) . "/class/database/DatabaseBlog.php";
require dirname(__FILE__) . "/class/database/DatabaseUtils.php";

global $dbAdmin, $dbBlog;

$dbAdmin = new DatabaseAdmin();
$dbBlog = new DatabaseBlog();