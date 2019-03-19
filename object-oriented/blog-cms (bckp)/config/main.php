<?php
# require ROOT_PATH . "/config/config.php";
require ROOT_PATH . "/class/database/dao/DAO.php";
require ROOT_PATH . "/class/database/DatabaseAdmin.php";
require ROOT_PATH . "/class/database/DatabaseBlog.php";
require ROOT_PATH . "/class/database/DatabaseUtils.php";

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