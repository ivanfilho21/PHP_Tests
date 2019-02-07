<?php include "header.html"; include "database/database.php"; include "util.php"; ?>
<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Website - Create Table</title>
	<link rel="stylesheet" type="text/css" href="styles/main_style.css">
	<link rel="stylesheet" type="text/css" href="styles/index_style.css">		
</head>
<body>
	<!-- Script -->
	<?php

	$error_msgs = array();
	$fields = array("table_name");
	$name = "";


	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$name = $_POST[$fields[0]];

		if (checkEmptyFields($fields))
			#createTable($connection, $name);
			# todo.
	}
	?>

	<div class="content">
		<!-- Title -->
		<h1>Create a Table</h1>

		<!-- Form -->
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<fieldset>
				<p><label>Name:</label></p>
				<span class="error">
				<?php
				if (isset($error_msgs["table_name"]))
					echo $error_msgs["table_name"];
				?>
				</span>
				<input type="text" name="table_name">

				<p><label>Number of Columns:</label></p>
				<input type="text" name="table_size">
				
				<div class="buttonHolder">
					<input type="submit" name="create_table" value="Create">
				</div>
			</fieldset>
		</form>

		<!-- Footer -->
		<?php include "footer.html"; ?>
	</div>

</body>
</html>