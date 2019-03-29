<?php
require "config.php";

checkUserPermissionToPage();

$util = new Util();
$announcements = $database->getAnnouncementsTable();

if ($util->checkMethod("GET")) {
	$id = $util->formatHTMLInput($_GET["id"]);

	$announcements->delete($id);
}
header("Location: my-announcements.php");
?>
<script>
	// window.location.href = "my-announcements.php";
</script>
<?php
exit();