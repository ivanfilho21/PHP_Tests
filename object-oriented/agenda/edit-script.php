<?php
require "util.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$id = formatInput($_GET["id"]);
	$contact = $contacts->getInfo($id);
}
else {
	header("Location: index.php");
	exit();
}