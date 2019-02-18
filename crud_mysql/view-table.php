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

			$columns = getTableColumns($connection, $name);

			# Insert button clicked
			if (isset($_POST["insert"])) {
				if (isset($_POST["data"]))
				{
					# data
					$error_msgs = array();
					$columnNames = array();
					$data = array();

					#$columns = getTableColumns($connection, $name);
					$notNullColumns = array();

					foreach ($columns as $column) {
						
						$info = getColumnInformation($connection, $name, $column);

						if ($info["IS_NULLABLE"] == "NO")
							$notNullColumns[$column] = "NO";

						# if EXTRA is empty the column has no extra info (auto_increment, etc.)

						if ($info["EXTRA"] != "auto_increment")
						{
							$columnNames[] = $column;
						}
					}

					if (validation())
					{
						insertIntoTable($connection, $name, $columnNames, $data);
						header("Location:view-table.php?table[{$name}]");
					}
				}
			}
			else {
				if (isset($_POST["delete-row"]))
				{
					foreach ($_POST["delete-row"] as $key => $v) {
						$value = $key;
						break;
					}

					# Gets primary key in current table
					$pk = getPrimaryKey($connection, $name);

					# If empty, first column name is used as pk (might not work with some tables)
					if (empty($pk))
						$cr = array_reverse($columns);
						$pk = array_pop($cr);

					#echo $pk;
					
					deleteFromTable($connection, $name, $pk, $value);
				}
			}

			function validation()
			{
				global $data, $notNullColumns, $error_msgs;
				$res = true;

				foreach ($_POST["data"] as $key => $value) {
					
					if (isset($notNullColumns[$key]))
					{
						if (empty($value))
						{
							$res = false;
							$error_msgs[$key] = "Can't be empty.";
						}
					}
					
					$data[] = format_input($value);
				}

				return $res;
			}
			?>

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
				<input class="button" type="submit" value="Drop Table" onClick="parent.location='index.php?delete-table[<?php echo $name; ?>]'" id="delete-table" style="margin-top: 3em;">
			</td>

		</div>

		<div class="clear-fix-main"></div>

	</main><!-- end main -->

	<?php include "footer.php"; ?>
</body>
</html>