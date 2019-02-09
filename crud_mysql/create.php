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
	$name = "";
	$attributes = array();

	# Get Columns from Session
	if (isset($_SESSION["columns"]))
		$columns = $_SESSION["columns"];

	# User clicked a submit button
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		# Add/Del column button clicked
		
		if (isset($_POST["columns"]))
		{
			switch ($_POST["columns"]) {
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
			# Validation
			if (validation())
			{
				echo "<h2>Validation OK{$name}</h2>";
				createTable($connection, $name, $attributes);
			}
			else echo "<h2>Validation Failed</h2>";
		}
	}

	function validation()
	{
		global $name, $attributes, $error_msgs;

		$res = true;
		$name = $_POST["table_name"];
		# ...

		$res = checkEmptyFields(array("table_name"));
		
		# test
		$col = array();
		$col = $_POST["column"];

		if (empty($col[0]))
		{
			$res = false;
			$error_msgs["name"] = "Name can't be empty.";
		}
		else
			$col[0] = strtoupper($col[0]) . " ";

		$col[1] = strtoupper($col[1]);

		if ($col[2] < 0)
		{
			$res = false;
			$error_msgs["length"] = "Invalid length.";
		}
		else
			$col[2] = "(" . $col[2] . ")";

		if (isset($col[3]))
			$col[3] = " NOT NULL";

		if (isset($col[4]))
			$col[4] = " PRIMARY KEY";

		$attributes = $col;
		return $res;
	}
	?>

	<div class="content">
		<!-- Title -->
		<h1>Create a Table</h1>

		<!-- Form -->
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<fieldset id="createFieldSet">
				<p>
					<label>Name:</label>
					<input name="table_name">

					<label>Columns: <?php echo $columns; ?></label>
					<input class="smallButton" type="submit" name="columns" value="+">
					<input class="smallButton" type="submit" name="columns" value="-">
				
				</p>
				<span class="error"><?php showError("table_name"); ?></span>
				
				<?php if ($columns > 0) : ?>
					<table>
						<!-- Table Headings -->
						<thead id="r01">
							<th>Nº</th>
							<th>Name</th>
							<th>Type</th>
							<th>Length</th>
							<th>Can be Null</th>
							<th>PK</th>
						</thead>
						
						<!-- Table Rows -->
						<tbody>
							<?php for ($i = 0; $i < $columns; $i++) : ?>
								<tr>
									<td>
										<?php echo ($i + 1); ?>
									</td>
									
									<td id="tdName">
										<input type="text" name="column[]">
										<span class="error"><?php showError("name"); ?></span>
									</td>

									<td>
										<select name="column[]">
											<option value="int">Int</option>
											<option value="varchar">Varchar</option>
											<option value="real">Real</option>
											<option value="text">Text</option>
											<option value="date">Date</option>
										</select>
									</td>

									<td>
										<input type="text" name="column[]">
										<span class="error"><?php showError("length"); ?></span>
									</td>

									<td align="center">
										<label>
											<input type="checkbox" name="column[]" value="0" />No
										</label>
									</td>

									<td align="center">
										<label>
											<input type="checkbox" name="column[]" value="0" />Yes
										</label>
									</td>

								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				<?php endif; ?>

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