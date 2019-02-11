<?php include "header.html"; include "database/database.php"; include "util.php"; session_start(); ?>

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
		<div class="dataHolder">
			<?php
			# TODO:
			# Show sign out button in nav bar

			$user = null;
			$userIsLogged = false;

			if (isset($_SESSION["connected_user"]))
			{
				$user = $_SESSION["connected_user"];
				$userIsLogged = true;
			}

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

			<h1>CRUD MySQL</h1>

			<?php if ($userIsLogged) : ?>
			<br>
			<h3>Logged User: <?php echo $user["username"]; ?></h3>
			<input type="submit" value="Create Table" onClick="parent.location='create.php'">

			<?php foreach ($tables as $value) : ?>
				<?php foreach ($value as $name) : ?>

					<h4><?php echo $name; ?></h4>

					<table>

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
			<?php else : ?>
				<h2>Description</h2>
				<p>
					This project consists of a simple Web Application where you may Create, Read, Update, and Delete entities from a Database. 
				</p>

				<br>
				<h3>You must have an account and be logged in to use this website.</h3>
				<input type="submit" value="Create Account" onClick="parent.location='registration.php'">
				<input type="submit" value="Login" onClick="parent.location='login.php'">
			<?php endif; ?>
		</div> <!-- DataHolder -->
		
		<?php include "footer.html"; ?>
	</div>
</body>
</html>