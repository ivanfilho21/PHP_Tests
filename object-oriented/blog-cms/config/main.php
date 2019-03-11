<?php
require "config/config.php";
require "class/database/dao/DAO.php";
require "class/database/DatabaseAdmin.php";
require "class/database/DatabaseBlog.php";
require "class/database/DatabaseUtils.php";

global $dbAdmin, $dbBlog;

$dbAdmin = new DatabaseAdmin();
$dbBlog = new DatabaseBlog();