<?php
checkUserPermissionToPage();

$util = new Util();
$announcements = $database->getAnnouncementsTable();

if ($util->checkMethod("GET")) {
	$id = $util->formatHTMLInput($_GET["id"]);
	$userId = getUserSession();
	$announcement = $database->getAnnouncementsTable()->getUserAnnouncement($database, $id, $userId);

	# var_dump($announcement);

	$categoryId = $announcement["categoryId"];
	$title = $announcement["title"];
	$condition = $announcement["condition"];
	$price = $announcement["price"];
	$description = $announcement["description"];

	#$announcements->editAnnouncement($id);
}