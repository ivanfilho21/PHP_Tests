<?php
require "Contact.php";
$contacts = new Contact();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = formatInput($_POST["email"]);
	$name = formatInput($_POST["name"]);

	if (empty($email)) {
		# TODO: show error
	}
	else {
		$contacts->add($email, $name);

		header("Location: index.php");
		exit();
	}		
	
	
}

function formatInput($data)
{
	if (isset($data)) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}

	return "";
}