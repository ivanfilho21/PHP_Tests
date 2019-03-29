<?php
require "config.php";
$util = new Util();
$pictures = $database->getAnnouncementImagesTable();

if ($util->checkMethod("GET")) {
	$id = $_GET["id"];

	# get announcementID from picture, then delete picture
	$pic = $pictures->get($id);
	$announcementId = $pic["announcementId"];

	$pictures->delete($id);

	header("Location: announcement.php?id=" .$announcementId);
	exit();
}
header("Location: ./");
exit();