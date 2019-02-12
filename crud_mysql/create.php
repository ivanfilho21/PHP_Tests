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
			if (validation() && count($attributes) > 0)
			{
				echo "<h2>Validation OK{$name}</h2>";
				createTable($connection, $name, $attributes);
			}
			else echo "<h2>Validation Failed</h2>";
		}
	}

	function validation()
	{
		global $name, $attributes, $columns, $error_msgs;

		$res = true;
		$name = $_POST["table_name"];
		$fields = array("name", "type", "length", "null", "pk");
		echo "  TABLE: " . $name . "   ";
		# ...

		$res = checkEmptyFields(array("table_name"));
		
		# test
		$col = array();
		for ($i = 0; $i < $columns; $i++)
		{
			$col[] = $_POST["column".$i];			
		}
		foreach ($col as $index=>$value)
		{
			echo "[{$index}]:  ";
			foreach ($value as $ind=>$v)
				echo " {$ind}: " . $v;
			echo "<br>";
		}

		foreach ($col as $index=>$value)
		{
			echo "<br>";
			if (empty($value["name"]))
			{
				$res = false;
				$error_msgs["name"] = "Can't be empty.";
			}
			else
				$col[$index]["name"] = strtolower($value["name"]) . " ";

			#debug
			#echo $value["name"] . "  ";

			$col[$index]["type"] = strtoupper($value["type"]);
			
			#debug
			#echo $value["type"] . "  ";

			if ((int)$value["length"] < 0)
			{
				$res = false;
				# err
			}
			else if ((int)$value["length"] == 0)
				$col[$index]["length"] = "";
			else
				$col[$index]["length"] = "(" . $value["length"] . ")";

			#debug
			#echo $value["length"] . "  ";

			if (isset($value["null"]))
				$col[$index]["null"] = " NOT NULL";

			if (isset($value["auto"]))
				$col[$index]["auto"] = " AUTO_INCREMENT";

			if (isset($value["pk"]))
				$col[$index]["pk"] = " PRIMARY KEY";

			#debug
			#if (isset($value["null"]))
			#	echo $value["null"] . "  ";
			#if (isset($value["pk"]))
			#	echo $value["pk"] . "  ";
		}


		foreach ($col as $index=>$value)
		{
			$txt = "";
			foreach ($value as $i=>$v)
			{
				$txt .= $v . " ";
			}
			$txt = substr($txt, 0, strlen($txt) - strlen(" "));
			echo "<br>" . $txt;

			$attributes[] = $txt;
		}

		return $res;
	}
	?>

	<div class="container">
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
							<th>Auto Increment</th>
							<th>Primary Key</th>
						</thead>
						
						<!-- Table Rows -->
						<tbody>
							<?php for ($i = 0; $i < $columns; $i++) : ?>
								<tr>
									<td>
										<?php echo ($i + 1); ?>
									</td>
									
									<td id="tdName">
										<input type="text" name="column<?php echo $i . "[name]"; ?>">
										<span class="error"><?php showError("name"); ?></span>
									</td>

									<td>
										<select name="column<?php echo $i . "[type]"; ?>">
											<option value="int">Int</option>
											<option value="varchar">Varchar</option>
											<option value="real">Real</option>
											<option value="text">Text</option>
											<option value="date">Date</option>
										</select>
									</td>

									<td>
										<input type="text" name="column<?php echo $i . "[length]"; ?>">
										<span class="error"><?php showError("length"); ?></span>
									</td>

									<td align="center">
										<label>
											<input type="checkbox" name="column<?php echo $i . "[null]"; ?>" value="0" <?php if ($i == 0) echo "checked='true'"; ?> />No
										</label>
									</td>

									<?php if ($i == 0) : ?>
									<td align="center">
										<label>
											<input type="checkbox" name="column<?php echo $i . "[auto]"; ?>" value="0" checked="true" />Yes
										</label>
									</td>

									<td align="center">
										<label>
											<input type="checkbox" name="column<?php echo $i . "[pk]"; ?>" value="0" checked="true" />Yes
										</label>
									</td>
									<?php endif; ?>

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