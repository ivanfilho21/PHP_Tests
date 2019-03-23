<?php
require "Contact.php";
require "util.php";

$contacts = new Contact();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$email = formatInput($_GET["email"]);
	
	if (! empty($email))
		$contacts->delete($email);
}
header("Location: index.php");
exit();