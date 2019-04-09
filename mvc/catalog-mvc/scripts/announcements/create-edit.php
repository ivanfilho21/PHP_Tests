<?php
$util = new Util();
$categories = $database->getCategoriesTable();
$announcements = $database->getAnnouncementsTable();
$announcement = array();
$created = false;
$createMode = true;

$id = (isset($id)) ? $id : "";
$userId = "";
$categoryId = "";
$title = "";
$condition = "";
$price = "";
$description = "";
$pictures = "";

if ($util->checkMethod("GET")) {
	if (! empty($id)) {
		$userId = getUserSession();
		$announcement = $database->getAnnouncementsTable()->get($id, $userId, $database);

		if (empty($announcement)) {
			?>
			<input id="data" type="hidden" data-base-url="<?php echo BASE_URL; ?>">
			<script>
				var baseUrl = document.getElementById("data").getAttribute("data-base-url");
				window.location.href = baseUrl + "announcements";
			</script>
			<?php
			#header("Location: " .BASE_URL ."announcements");
			exit();
		}

		$source = $announcement;

		$categoryId = $source["categoryId"];
		$title = $source["title"];
		$condition = $source["condition"];
		$price = $source["price"];
		$description = $source["description"];
		$pictures = $announcement["pictures"];

		$createMode = false;
	}	
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

	# CREATE
	if (isset($_POST["create"])) {
		$userId = getUserSession();
		$categoryId = $util->formatHTMLInput($_POST["categoryId"]);
		$title = $util->formatHTMLInput($_POST["title"]);
		$condition = $util->formatHTMLInput($_POST["condition"]);
		$price = $util->formatHTMLInput($_POST["price"]);
		$description = $util->formatHTMLInput($_POST["description"]);
		$pictures = (isset($_FILES["pictures"])) ? $_FILES["pictures"] : array();

		# TODO: validation
		$announcementArray = array("userId" => $userId, "categoryId" => $categoryId, "title" => $title, "condition" => $condition, "price" => $price, "description" => $description);

		$announcements->insert($announcementArray, $pictures, $database);
		$created = true;
	}
	# EDIT
	elseif ($source["edit"]) {
		$pictures = (isset($_FILES["pictures"])) ? $_FILES["pictures"] : array();

		# TODO: validation
		$announcementArray = array("id" => $id, "userId" => $userId, "categoryId" => $categoryId, "title" => $title, "condition" => $condition, "price" => $price, "description" => $description);

		$announcements->update($announcementArray, $pictures, $database);
		?>
		<input id="base-url" type="hidden" data-base-url="<?php echo BASE_URL; ?>">
		<script>
			var baseUrl = document.getElementById("base-url").getAttribute("data-base-url");
			window.location.href = baseUrl + "announcements";
		</script>
		<?php
		#header("Location: " .BASE_URL ."announcements");
		exit();
	}
}