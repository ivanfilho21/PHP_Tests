<?php
$announcements = $database->getAnnouncementsTable();
$users = $database->getUsersTable();
$totalAnnouncements = count($announcements->getAll());
$totalUsers = count($users->getAll());

$currentPage = 1;
$maxPerPage = 2;
$maxPages = ceil($totalAnnouncements / $maxPerPage);

$categories = $database->getCategoriesTable();

$util = new Util();

if ($util->checkMethod("GET")) {
	$p = (isset($_GET["p"])) ? $util->formatHTMLInput($_GET["p"]) : 1;
	$currentPage = ($p <= $maxPages) ? $p : $maxPages;
}