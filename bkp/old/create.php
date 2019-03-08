<?php
include "header.html";
include "database/database.php";
include "scripts/util.php";
session_start();
?>

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
	<?php include "scripts/crud/create_table.php"; ?>

	<div class="container">
		<div class="content">
			<div class="contentLeft">
				<?php include "sidebar.php"; ?>
			</div>

			<div class="contentRight">
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
			</div>
		</div>
	</div>
	<!-- Footer -->
	<?php include "footer.html"; ?>

</body>
</html>