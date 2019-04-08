<?php
checkUserPermissionToPage();

$util = new Util();
$announcements = $database->getAnnouncementsTable();
$announcements->delete($id);
?>
<script>
	// window.location.href = "my-announcements.php";
</script>
<?php
header("Location: " .BASE_URL ."announcements");
exit();