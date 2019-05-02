<?php

$err = array();
$task = array(
	"name" => (! empty($_POST["name"])) ? formatInput($_POST["name"]) : "",
	"description" => (! empty($_POST["description"])) ? formatInput($_POST["description"]) : "",
	"priority" => (! empty($_POST["priority"])) ? formatInput($_POST["priority"]) : "",
	"finished" => (! empty($_POST["finished"])) ? formatInput($_POST["finished"]) : "",
	"date_creation" => (! empty($_POST["created"])) ? formatInput($_POST["created"]) : date("Y-m-d"),
	"deadline" => (! empty($_POST["deadline"])) ? formatInput($_POST["deadline"]) : date("Y-m-d")
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (validation()) {
		$taskDB->insert($task);
		header("Location: index.php");
		die;
	}
}

function formatInput($input) {
	return $input;
}

function validation() {
	global $err;
	$res = true;

	if (empty($task["name"])) {
		$res = false;
		$err["name"] = "Specify the Task Name.";
	}

	if ($res) {
		// attachment
	}

	return $res;
}

function getErrorMessage($index) {
	global $err;
	echo (isset($err[$index])) ? $err[$index] : "";
}