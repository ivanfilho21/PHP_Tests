<?php
$announcements = $database->getAnnouncementsTable();
$users = $database->getUsersTable();

$currentPage = 1;
$maxPerPage = 2;

$util = new Util();

if ($util->checkMethod("GET")) {
	$p = (isset($_GET["p"])) ? $util->formatHTMLInput($_GET["p"]) : 1;
	$currentPage = $p;	
}

$latestAnnouncements = $announcements->getLatest($database, $currentPage, $filter, $maxPerPage);
$totalAnnouncements = count($announcements->getAll("", "", $filter));
$maxPages = ($maxPerPage > 0) ? ceil($totalAnnouncements / $maxPerPage) : 1;

$categories = $database->getCategoriesTable();
$totalUsers = count($users->getAll());