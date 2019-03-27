<?php
$util = new Util();
$categories = $database->getCategoriesTable();
$announcements = $database->getAnnouncementsTable();

# User not logged
if (empty(getUserSession())) {
	?>
	<script>window.location.href = "./"</script>
	<?php
	exit();
}

if ($util->checkMethod("POST")) {
	if (isset($_POST["create"])) {
		$userId = getUserSession();
		$categoryId = $util->formatHTMLInput($_POST["category"]);
		$title = $util->formatHTMLInput($_POST["title"]);
		$condition = $util->formatHTMLInput($_POST["condition"]);
		$price = $util->formatHTMLInput($_POST["price"]);
		$description = $util->formatHTMLInput($_POST["description"]);

		# validation
		$announcementArray = array("userId" => $userId, "categoryId" => $categoryId, "title" => $title, "condition" => $condition, "price" => $price, "description" => $description);

		$announcements->addAnnouncement($announcementArray);
	}
}