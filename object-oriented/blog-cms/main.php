<?php

require dirname(__FILE__) . "/config/config.php";
require dirname(__FILE__) . "/class/database/dao/DAO.php";
require dirname(__FILE__) . "/class/database/DatabaseAdmin.php";
require dirname(__FILE__) . "/class/database/DatabaseBlog.php";
require dirname(__FILE__) . "/class/database/DatabaseUtils.php";

global $dbAdmin, $dbBlog, $relPath;

$dbAdmin = new DatabaseAdmin();
$dbBlog = new DatabaseBlog();

# Relative Path to root (index) folder
# TODO: move these methods to Util class
function getCurrentRelPath()
{
	global $relPath;
	return $relPath;
}

function setCurrentRelPath($rel)
{
	global $relPath;
	$relPath = $rel;
}