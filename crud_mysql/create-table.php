<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - Create Table</title>
	
	<?php include "header_elements.php"; ?>

	<link rel="stylesheet" type="text/css" href="styles/index.css">
</head>
<body>
	<?php
	include "database/database.php";
	include "scripts/util.php";
	session_start();
	include "scripts/verify_user_session.php";
	?>

	<div class="header-container">
		<?php include "header.php"; ?>
	</div><!-- end header container -->

	<main>
		<?php include "scripts/crud/create_table.php"; ?>
		<div class="page-content">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<fieldset id="createFieldSet">
					<p>
						<label>Table Name:</label>
						<input name="table_name">
						<span class="error"><?php showError("table_name"); ?></span>

						<label>Columns: <?php echo $columns; ?></label>
						<input id="add-row" type="submit" name="columns" value="+">
						<input id="delete-row" type="submit" name="columns" value="-">
					
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
									<?php if ($i % 2 != 0) : ?>
									<tr class="spRow">
									<?php else : ?>
									<tr>
									<?php endif; ?>
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

					<input type="submit" name="create_table" value="Create">
				</fieldset>
			</form><!-- end form -->
		</div>
	</main><!-- end main -->

	<?php include "footer.php"; ?>
</body>
</html>