<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$q = $_REQUEST["q"];

	if (strlen($q) <= 8) {
		echo "Weak";
	} else {
		echo "Strong";
	}
}