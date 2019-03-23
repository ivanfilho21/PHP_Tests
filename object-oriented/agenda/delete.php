<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["email"])) {
		$email = $_GET["email"];

		echo "Can't process corn right now. I need the contacts object.";

		# Somehow get the contacts object
		# contacts->delete($email);
	}
}
?>
<!-- Temp -->
<br><br>
<a href="index.php">Return to Home Page</a>