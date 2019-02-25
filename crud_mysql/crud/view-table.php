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

			<table>
				<thead>
					<?php foreach ($columns as $column) : ?>
						<th style="width: auto;"><?php echo $column; ?></th>
					<?php endforeach; ?>

					<th style="width: 32px;"></th>
				</thead>

				<tbody>
					<tr>
						<form action="" method="post">
							<?php foreach ($columns as $column) : ?>

								<!-- TODO: check primary key instead -->
								<?php if ($column == "id") : ?>
									<td></td>
								<?php else: ?>
									<td>
										<input type="text" name="data[<?php echo $column; ?>]">
										<span class="error"><?php showError($column); ?></span>
									</td>
								<?php endif; ?>
							<?php endforeach; ?>

							<td>
								<input type="submit" name="insert" value="+">
							</td>
						</form>
					</tr>

					<?php $rows = getTableContent($connection, $name); ?>
					
						<?php foreach ($rows as $key => $row) : ?>
							<tr>
								<?php foreach ($row as $k => $rowName) : ?>
									<td><?php echo $rowName; ?></td>
								<?php endforeach; ?>

								<form action="" method="post">
									<?php if (count($rows) > 0) : ?>
										<td>
											<input type="submit" name="delete-row[<?php echo $rows[$key][$pk]; ?>]" value="-">


											<!-- TODO: get the primary key instead of hard-coded 'id' -->
										</td>
									<?php endif; ?>
								</form>
							</tr>
						<?php endforeach; ?>

				</tbody>
			</table>

			<td>
				<input class="button" type="submit" value="Update" onclick="parent.location='update-table.php?table[<?php echo $name; ?>]'" id="update-table" style="margin-top: 3em;">
				<input class="button" type="submit" value="Drop" onclick="parent.location='<?php echo $PATH; ?>index.php?delete-table[<?php echo $name; ?>]'" id="delete-table" style="margin-top: 3em;">
			</td>
		</div>

		<div class="clear-fix-main"></div>

	</main><!-- end main -->

	<?php include $PATH . "footer.php"; ?>
</body>
</html>