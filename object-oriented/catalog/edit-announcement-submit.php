<?php
checkUserPermissionToPage();

$util = new Util();
$announcements = $database->getAnnouncementsTable();
$categories = $database->getCategoriesTable();
$source = null;

if ($util->checkMethod("GET")) {
	$source = $_GET;
	$id = $util->formatHTMLInput($source["id"]);
	$userId = getUserSession();
	$announcement = $database->getAnnouncementsTable()->getUserAnnouncement($database, $id, $userId);

	# var_dump($announcement);
	$source = $announcement;

	$categoryId = $source["categoryId"];
	$title = $source["title"];
	$condition = $source["condition"];
	$price = $source["price"];
	$description = $source["description"];
}
elseif ($util->checkMethod("POST")) {
	$source = $_POST;
	$id = $source["id"];
	$userId = getUserSession();
	$categoryId = $source["categoryId"];
	$title = $source["title"];
	$condition = $source["condition"];
	$price = $source["price"];
	$description = $source["description"];

	if ($source["edit"]) {
		$announcementArray = array("id" => $id, "userId" => $userId, "categoryId" => $categoryId, "title" => $title, "condition" => $condition, "price" => $price, "description" => $description);

		$announcements->editAnnouncement($announcementArray);
		header("Location: my-announcements.php");
		?>
		<script>
			// window.location.href = "my-announcements.php";
		</script>
		<?php
		exit();
	}
}