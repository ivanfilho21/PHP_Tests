<?php
checkUserPermissionToPage();

$util = new Util();
$pictures = $database->getAnnouncementImagesTable();

# get announcementID from picture, then delete picture
$pic = $pictures->get($id);
$announcementId = $pic["announcementId"];

$pictures->delete($id);

header("Location: " .BASE_URL ."announcements/edit/" .$announcementId);
exit();