<?php
checkUserPermissionToPage();

$util = new Util();
$announcements = $database->getAnnouncementsTable();
$announcements->delete($id);
?>
<input id="data" type="hidden" data-base-url="<?php echo BASE_URL; ?>">
<script>
	var baseUrl = document.getElementById("data").getAttribute("data-base-url");
	window.location.href = baseUrl + "announcements";
</script>
<?php
#header("Location: " .BASE_URL ."announcements");
exit();