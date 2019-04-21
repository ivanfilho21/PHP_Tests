<?php
$util = new Util();
$announcements = $database->getAnnouncementsTable();

$currentPage = 1;
$maxPerPage = 2;

$filter = array();



if (! empty($_GET["q"])) {
	$name = $util->formatHTMLInput($_GET["q"]);
	$results = $announcements->search($name, $database, $currentPage, $filter, $maxPerPage);
} else {
	?>
	<div id="link" data-link="<?php echo BASE_URL; ?>"></div>
	<script>
		window.location.href = document.getElementById("link").getAttribute("data-link");
	</script>
	<?php
	exit();
}