<?php
$announcements = $database->getAnnouncementsTable();
$users = $database->getUsersTable();

$currentPage = 1;
$maxPerPage = 2;
$latestAnnouncements = $announcements->getLatest($database, $currentPage, $filter);
$totalAnnouncements = count($latestAnnouncements);#count($announcements->getAll());
$maxPages = ($maxPerPage > 0) ? ceil($totalAnnouncements / $maxPerPage) : 1;

$categories = $database->getCategoriesTable();

$util = new Util();

if ($util->checkMethod("GET")) {
	$p = (isset($_GET["p"])) ? $util->formatHTMLInput($_GET["p"]) : 1;
	#$currentPage = ($p <= $maxPages) ? $p : $maxPages;
	$currentPage = $p;	
}

#echo "Total of announcements: " .$totalAnnouncements;
$totalUsers = count($users->getAll());