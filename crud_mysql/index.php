<?php include "header.html"; include "database/database.php"; include "util.php"; ?>

<!DOCTYPE html!>
<html>
<head>
	<meta charset="UTF-8">
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
		?>
		
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