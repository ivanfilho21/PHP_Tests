<?php

$page = ! empty($_GET["p"]) ? $_GET["p"] : 1;
$qtyPerPage = 25;
$size = DB::count("megasena");

$currentSkip = $page > 1 ? ($page - 1) * $qtyPerPage : 0;
$pageCounter = ($qtyPerPage > 0) ? ceil($size / $qtyPerPage) : 1;

$showLeft = 5; // Max of pages to the left
$showRight = 3; // Max of pages to the right

// echo "Page: " .$page .", skip: " .$currentSkip;