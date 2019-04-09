<?php
# checkUserPermissionToPage();
$util = new Util();

$info = $database->getAnnouncementsTable()->get($id, "", $database);

if (empty($info)) {
	# redirect
	?>
	<input id="data" type="hidden" data-base-url="<?php echo BASE_URL; ?>">
	<script>
		var baseUrl = document.getElementById("data").getAttribute("data-base-url");
		window.location.href = baseUrl;
	</script>
	<?php
	#header("Location: " .BASE_URL);
	exit();
}

$title = $info["title"];
$price = $info["price"];
$description = $info["description"];
$pictures = (isset($info["pictures"])) ? $info["pictures"] : array();