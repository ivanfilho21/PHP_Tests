<?php $PATH = "../"; ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - View Table</title>
	
	<?php include $PATH . "header_elements.php"; ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $PATH; ?>styles/index.css">
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
		<?php include $PATH . "sidebar.php"; ?>

		<div class="page-content">
			<?php include $PATH . "scripts/crud/read_table.php"; ?>
			<?php include $PATH . "scripts/crud/update_row.php"; ?>

			<form action="" method="post">
				<table>
					<thead>
						<tr>
							<?php foreach ($columns as $column) : ?>
								<th style="width: auto;"><?php echo $column; ?></th>
							<?php endforeach; ?>
						</tr>
					</thead>

					<tbody>
						<tr>
							<?php foreach ($columns as $column) : ?>
								<?php if ($column == $pk) : ?>
									<td></td>
								<?php else: ?>
									<td>
										<input type="text" name="data[<?php echo $column; ?>]">
										<span class="error"><?php showError($column); ?></span>
									</td>
								<?php endif; ?>
							<?php endforeach; ?>
						</tr>
					</tbody>
				</table>

				<input type="submit" name="insert" value="Add <?php echo (substr($name,-1) == "s") ? substr($name, 0, -1) : $name; ?>">
			</form>

			<?php $rows = getTableContent($connection, $name); ?>
			
			<?php if (count($rows) > 0) : ?>

				<h2>List of <?php echo $name; ?></h2>
				
				<form action="" method="post">
					<input type="submit" name="edit-mode" value="Enable Edit Fields">
				</form>

				<table>
					<thead>
						<tr>
							<?php foreach ($columns as $column) : ?>
								<th style="width: auto;"><?php echo $column; ?></th>
							<?php endforeach; ?>

							<th>Operations</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($rows as $key => $row) : ?>
							<tr>
								<form action="" method="post">
									<?php foreach ($row as $k => $value) : ?>
										<td>
											<?php if ($k != $pk) : ?>
												<input type="text" name="<?php echo $k; ?>" value="<?php echo $value; ?>">
												
												<?php if ($editMode) : ?>
													<input type="submit" name="edit-row[<?php echo $rows[$key][$pk]; ?>][<?php echo $k; ?>]" value="Edit">
												<?php endif; ?>

											<?php else : ?>
												<input type="text" name="id" value="<?php echo $value; ?>" readonly style="width: 32px; text-align: center;">
											<?php endif; ?>
										</td>
									<?php endforeach; ?>
								</form>

								<form action="" method="post">
									<?php if (count($rows) > 0) : ?>
										<td>
											<input type="submit" name="delete-row[<?php echo $rows[$key][$pk]; ?>]" value="Delete">
										</td>
									<?php endif; ?>
								</form>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>

			<h3 style="margin-top: 3em;">Danger Zone</h3>

			<td>
				<input class="button" type="submit" value="Update" onclick="parent.location='update-table.php?table[<?php echo $name; ?>]'" id="update-table">
				<input class="button" type="submit" value="Drop" onclick="parent.location='<?php echo $PATH; ?>index.php?delete-table[<?php echo $name; ?>]'" id="delete-table">
			</td>
		</div>

		<div class="clear-fix-main"></div>

	</main><!-- end main -->

	<?php include $PATH . "footer.php"; ?>
</body>
</html>