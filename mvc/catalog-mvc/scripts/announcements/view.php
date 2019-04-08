<?php
# checkUserPermissionToPage();
$util = new Util();

$info = $database->getAnnouncementsTable()->get($id, "", $database);

if (empty($info)) {
	# redirect
	?>
	<!-- <script>window.location.href = "./";</script> -->
	<?php
	header("Location: " .BASE_URL);
	exit();
}

$title = $info["title"];
$price = $info["price"];
$description = $info["description"];
$pictures = (isset($info["pictures"])) ? $info["pictures"] : array();