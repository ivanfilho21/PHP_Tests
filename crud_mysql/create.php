<?php include "header.html"; include "database/database.php"; include "util.php"; session_start(); ?>
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
	$columns = 0;
	$fields = array("table_name");
	$name = "";

	# Get Columns from Session
	if (isset($_SESSION["columns"]))
		$columns = $_SESSION["columns"];

	# User clicked a submit button
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		# Add/Del column button clicked
		$colSrc = $_POST["columns"];
		if (isset($colSrc))
		{
			switch ($colSrc) {
				case "+":
					$columns++;
					break;
				case "-":
					if ($columns > 0)
						$columns--;
					break;
			}
			
			$_SESSION["columns"] = $columns;
		}
		# Create button clicked
		else
		{
			$name = $_POST[$fields[0]];

			# Validate all Fields
			if (checkEmptyFields($fields))
			{
				#createTable($connection, $name);
				# todo.
			}
		}
		
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

				<?php if ($columns > 0) : ?>
					<p>
						<label>Attribute Name,</label>
						<label>Type,</label>
						<label>Value,</label>
						<label>Not null?,</label>
						<label>Primary Key?,</label>
						<label>Auto Increment?</label>
					</p>
				<?php endif; ?>
				<?php for ($i = 0; $i < $columns; $i++) : ?>
					<p>
						<?php echo ($i + 1) ?>
						<input type="text" name="attribute_name[]">
						<input type="text" name="attribute_value[]">
					</p>
				<?php endfor; ?>

				<p>
					<label>Columns: <?php echo $columns; ?></label>
					<input type="submit" name="columns" value="+">
					<input type="submit" name="columns" value="-">
				</p>

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