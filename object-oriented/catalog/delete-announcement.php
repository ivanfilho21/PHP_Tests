<?php
require "config.php";

checkUserPermissionToPage();

$util = new Util();
$announcements = $database->getAnnouncementsTable();

if ($util->checkMethod("GET")) {
	$id = $util->formatHTMLInput($_GET["id"]);

	$announcements->deleteAnnouncement($id);
}
header("Location: my-announcements.php");
exit();