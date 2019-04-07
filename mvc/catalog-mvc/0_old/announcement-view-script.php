<?php
# checkUserPermissionToPage();
$util = new Util();

$title = "";
$firstPictureUrl = "";

if ($util->checkMethod("GET")) {
	$id = (isset($_GET["id"])) ? $util->formatHTMLInput($_GET["id"]) : "";

	if (empty($id)) {
		# redirect
		?>
		<script>window.location.href = "./";</script>
		<?php
		exit();
	}

	$info = $database->getAnnouncementsTable()->get($id, "", $database);

	if (empty($info)) {
		# redirect
		?>
		<script>window.location.href = "./";</script>
		<?php
		exit();
	}

	$title = $info["title"];
	$price = $info["price"];
	$description = $info["description"];
	$url = (isset($info["pictures"]) && isset($info["pictures"][0])) ? $info["pictures"][0]["url"] : null;
}