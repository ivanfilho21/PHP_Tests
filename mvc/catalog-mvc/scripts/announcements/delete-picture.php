<?php
checkUserPermissionToPage();

$util = new Util();
$pictures = $database->getAnnouncementImagesTable();

# get announcementID from picture, then delete picture
$pic = $pictures->get($id);
$announcementId = $pic["announcementId"];

$pictures->delete($id);

?>
<input id="data" type="hidden" data-base-url="<?php echo BASE_URL; ?>" data-announcement-id="<?php echo $announcementId; ?>">
<script>
	var data = document.getElementById("data");
	var baseUrl = data.getAttribute("data-base-url");
	var announcementId = data.getAttribute("data-announcement-id");
	window.location.href = baseUrl + "announcements/edit/" + announcementId;
</script>
<?php
#header("Location: " .BASE_URL ."announcements/edit/" .$announcementId);
exit();