<?php include "header.html"; include "database/database.php"; include "util.php"; ?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Website - Home Page</title>
	<link rel="stylesheet" type="text/css" href="styles/main_style.css">
	<link rel="stylesheet" type="text/css" href="styles/index_style.css">
</head>
<body>
	<div class="content">
	
		<h3>Logged User: <?php echo "Foobar"; ?></h3>
		<h1>List</h1>
		
		<div class="dataHolder">
			<input type="submit" name="add" value="Add">
			
			<?php
			# Show this content only if user is logged as Admin.
			# Show table if data exists in Database.

			$tables = getTableList($connection);
			# debugging
			/*
			foreach ($tables as $key => $value) {
				foreach ($value as $k => $v) {
					echo "<br>" . $v;
					$col = getTableColumns($connection, $v);
					foreach ($col as $index => $column) {
						foreach ($column as $i => $c) {
							echo "  " . $c;
						}
					}
				}
			}
			*/
			?>

			<table>
				<caption>Tables in Database</caption>

				<thead>
					<th>Table</th>
				</thead>

				<tbody>
					<?php foreach ($tables as $value) : ?>
						<?php foreach ($value as $name) : ?>
							<tr><td><?php echo $name; ?></td></tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?php foreach ($tables as $value) : ?>
				<?php foreach ($value as $name) : ?>
					<table>
						<caption><?php echo $name; ?></caption>
						<?php $columns = getTableColumns($connection, $name); ?>
						<thead>
							<?php foreach ($columns as $column) : ?>
								<?php foreach ($column as $cName) : ?>
									<th><?php echo $cName; ?></th>
								<?php endforeach; ?>
							<?php endforeach; ?>
						</thead>
						<tbody>
							<?php $rows = getTableContent($connection, $name); ?>
							<tr>
								<?php foreach ($rows as $row) : ?>
									<?php foreach ($row as $rName) : ?>
										<td><?php echo $rName; ?></td>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</tr>
						</tbody>
					</table>
				<?php endforeach; ?>
			<?php endforeach; ?>
			
			<br>
			<table>
				<!-- Table Headings -->
				<thead id="r01">
					<th>Heading 1</th>
					<th>Heading 2</th>
					<th>Heading 3</th>
					<th>Heading 4</th>
				</thead>
				
				<!-- Table Rows -->
				<tbody>
					<tr>
						<!-- Table Data -->
						<td>Data</td>
						<td>Data</td>
						<td>Data</td>
						<td>Data</td>
					</tr>
					
					<tr class="spRow">
						<td>Data</td>
						<td>Data</td>
						<td>Data</td>
						<td>Data</td>
					</tr>
					
					<tr>
						<td>Data</td>
						<td>Data</td>
						<td>Data</td>
						<td>Data</td>
					</tr>
				</tbody>
			
			</table>
		</div> <!-- DataHolder -->
		
		<?php include "footer.html"; ?>
	</div>
</body>
</html>