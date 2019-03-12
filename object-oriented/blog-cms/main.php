<?php

require __DIR__ . "/config/config.php";

require __DIR__ . "/class/User.php";

require __DIR__ . "/class/database/dao/DAO.php";
require __DIR__ . "/class/database/DatabaseAdmin.php";
require __DIR__ . "/class/database/DatabaseBlog.php";
require __DIR__ . "/class/database/DatabaseUtils.php";

global $dbAdmin, $dbBlog;

$dbAdmin = new DatabaseAdmin();
$dbBlog = new DatabaseBlog();