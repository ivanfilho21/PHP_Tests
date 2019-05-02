<?php

$err = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$array = validation();

	if ($array != false) {
		$taskDB->insert($array);
	}
}

function formatInput($input) {
	return $input;
}

function validation() {
	$res = true;
	$array = array();

	return ($res) ? $array : $res;
}