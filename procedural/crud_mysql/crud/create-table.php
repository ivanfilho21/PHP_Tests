<?php $PATH = "../"; ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - Create Table</title>
	
	<?php include $PATH . "header_elements.php"; ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $PATH; ?>styles/crud.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $PATH; ?>styles/sidebar.css">
</head>
<body>
	<?php
	include $PATH . "database/database.php";
	include $PATH . "scripts/util.php";
	session_start();
	include $PATH . "scripts/verify_user_session.php";
	include $PATH . "scripts/verify_user_logged.php";
	?>

	<div class="header-container">
		<?php include $PATH . "header.php"; ?>
	</div><!-- end header container -->

	<main>
		<?php include $PATH . "scripts/crud/create_table.php"; ?>
		<?php include $PATH . "sidebar.php"; ?>

		<div class="page-content">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<fieldset id="createFieldSet">
					
					<p>
						<label>Table Name:</label>
						<input name="table_name" <?php if (isset($_POST["table_name"])) echo "value='{$_POST["table_name"]}'"; ?>>
					</p>

					<p>
						<span class="error"><?php showError("table_name"); ?></span>
					</p>
					
					<p>
						<label>Columns: <?php echo $columns; ?></label>
						<input class="button" id="create" type="submit" name="columns" value="+">
						<input class="button" id="delete" type="submit" name="columns" value="-">
					</p>

					<p>
						<span class="error"><?php showError("columns"); ?></span>
					</p>
					
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
											<input type="text" name="column<?php echo $i . "[name]";?>"
											<?php
											if (isset($COL[$i]["name"]))
												echo "value='". $COL[$i]["name"] ."'";
											?>
											>
											<span class="error">
												<?php if (isset($error_msgs[$i]["name"])) echo $error_msgs[$i]["name"]; ?>
											</span>
										</td>

										<td>
											<select name="column<?php echo $i . "[type]"; ?>">
												<?php foreach ($SELECT as $k => $v) : ?>
												<option value="<?php echo $v; ?>" 
													<?php
													if (isset($COL[$i]["type"]))
														if ($v == $COL[$i]["type"])
															echo "selected='selected'";
													?>><?php echo $v; ?></option>
												<?php endforeach; ?>
											</select>
										</td>

										<td>
											<input type="text" name="column<?php echo $i . "[length]"; ?>"
											<?php
											if (isset($COL[$i]["length"]))
												echo "value='". $COL[$i]["length"] ."'";
											?>
											>
											
											<span class="error">
												<?php if (isset($error_msgs[$i]["length"])) echo $error_msgs[$i]["length"]; ?>
											</span>
										</td>

										<td align="center">
											<label>
												<input type="checkbox" name="column<?php echo $i . "[null]"; ?>" value="0"
												<?php
												

												if ( isset($COL[$i]["null"]) )
													echo "checked='true'";
												else 
												{
													if ($i == 0)
														echo "checked='true'";
												}

												?>
												/> No
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
										<?php else: ?>
											<td></td>
											<td></td>
										<?php endif; ?>

									</tr>
								<?php endfor; ?>
							</tbody>
						</table>
					<?php endif; ?>

					<input class="button" type="submit" name="create_table" value="Create">
				</fieldset>
			</form><!-- end form -->
		</div>

		<div class="clear-fix-main"></div>
	</main><!-- end main -->

	<?php include $PATH . "footer.php"; ?>
</body>
</html>