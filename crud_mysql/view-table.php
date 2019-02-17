<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MySQL - View Table</title>
	
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
		<?php if ($userIsLogged) : ?>
			<?php include "sidebar.php"; ?>
		<div class="page-content">
		<?php else : ?>
		<div class="page-content" style="width: 100%;">
		<?php endif; ?>
			
			<?php
			if (isset($_GET["table"]))
			{
				foreach ($_GET["table"] as $key => $value) {
					$name = $key;
					break;
				}
				echo "<h1>Table {$name}</h1>";
			}

			# Insert button clicked

			if (isset($_POST["data"])) {
				echo "HELLO ...";

				$columnNames = array();
				$columns = getTableColumns($connection, $name);

				# data
				$data = array();

				foreach ($columns as $column) {
					$cn = $column["COLUMN_NAME"];
					if ($cn != "id")
						$columnNames[] = $cn;
					echo " [{$cn}]";
				}

				foreach ($_POST["data"] as $key => $value) {
					$data[] = format_input($value);
				}

				# After Validation
				insertIntoTable($connection, $name, $columnNames, $data);
				header("Location:view-table.php?table[{$name}]");
			}
			?>

			<table>
				<?php $columns = getTableColumns($connection, $name); ?>

				<thead>
					<?php foreach ($columns as $column) : ?>
						<?php foreach ($column as $cName) : ?>
							<th style="width: auto;"><?php echo $cName; ?></th>
						<?php endforeach; ?>
					<?php endforeach; ?>

					<th style="width: 32px;"></th>

				</thead>

				<tbody>
					<tr>
						<form action="" method="post">
							<?php foreach ($columns as $column) : $cName = $column["COLUMN_NAME"]; ?>

								<?php if ($cName == "id") : ?>
									<td></td>
								<?php else: ?>
									<td><input type="text" name="data[<?php echo $cName; ?>]"></td>
									
								<?php endif; ?>
							<?php endforeach; ?>

							<td>
								<input type="submit" name="insert" value="+">
							</td>
						</form>
					</tr>

					<?php $rows = getTableContent($connection, $name); ?>
					
						<?php foreach ($rows as $row) : ?>
							<tr>
								<?php foreach ($row as $rName) : ?>
									<td><?php echo $rName; ?></td>
								<?php endforeach; ?>

								<?php if (count($rows) > 0) : ?>
									<td>
										<input type="submit" name="delete-row" value="-">
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>

						<!-- TODO: delete record from table -->
						<!-- DELETE FROM `dogs` WHERE `dogs`.`id` = 1; -->

				</tbody>
			</table>

			<td>
				<input class="button" type="submit" value="Delete" onClick="parent.location='index.php?delete-table[<?php echo $name; ?>]'" id="delete-table" style="margin-top: 3em;">
			</td>

		</div>

		<div class="clear-fix-main"></div>

	</main><!-- end main -->

	<?php include "footer.php"; ?>
</body>
</html>