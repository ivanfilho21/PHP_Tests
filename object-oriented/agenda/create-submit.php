<?php
require "Contact.php";
require "util.php";

$contacts = new Contact();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = formatInput($_POST["email"]);
	$name = formatInput($_POST["name"]);

	if (empty($email)) {
		# TODO: show error
	}
	else {
		$contacts->add($email, $name);
	}		
	
	
}
header("Location: index.php");
exit();