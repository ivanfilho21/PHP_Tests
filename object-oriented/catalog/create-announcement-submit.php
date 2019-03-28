<?php
checkUserPermissionToPage();

$util = new Util();
$categories = $database->getCategoriesTable();
$announcements = $database->getAnnouncementsTable();
$created = false;

if ($util->checkMethod("POST")) {
	if (isset($_POST["create"])) {
		$userId = getUserSession();
		$categoryId = $util->formatHTMLInput($_POST["category"]);
		$title = $util->formatHTMLInput($_POST["title"]);
		$condition = $util->formatHTMLInput($_POST["condition"]);
		$price = $util->formatHTMLInput($_POST["price"]);
		$description = $util->formatHTMLInput($_POST["description"]);

		# validation
		if (validation($price)) {
			$announcementArray = array("userId" => $userId, "categoryId" => $categoryId, "title" => $title, "condition" => $condition, "price" => $price, "description" => $description);

			$announcements->addAnnouncement($announcementArray);
			$created = true;
		}
	}
}

function validation($price)
{
	global $util;
	$res = true;

	if (number_format($price) <= 1) {
		$res = false;
		$util->setErrorMessage("price", "The price must be greater than $ 1.00");
	}

	return $res;
}