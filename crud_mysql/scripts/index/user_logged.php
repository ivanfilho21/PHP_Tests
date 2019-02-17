<?php

if (isset($_GET["delete-table"]))
	deleteTable();

function deleteTable()
{
	global $connection;
	
	if (isset($_GET["delete-table"]))
	{
		foreach ($_GET["delete-table"] as $key => $v)
		{
			#echo $key . " ";
			dropTable($connection, $key);
			header("Location:index.php");
		}

	}
}
?>

<h1 style="margin-bottom: 1em; ">Tables</h1>

<input class="button" id="create-table" type="submit" value="Create Table" onClick="parent.location='create-table.php'">

<table>
	
	<?php if (count($tables) > 0) : ?>
	<thead>
		<th>Name</th>
		<th>Action</th>
	</thead>
	<?php endif; ?>

	<tbody>
		<?php foreach ($tables as $value) : ?>
			<?php foreach ($value as $name) : ?>
				
				<tr>
					<td>

						<a href="view-table.php?table[<?php echo $name; ?>]"><?php echo $name; ?></a>

						<table style="display: none;">
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
					</td>

					<td>
						<!--
						<input type="submit" value="Update" onclick="" id="update-table">
						<div style="display: inline-block; height: 16px; border-left: 1px solid #a09d9d; vertical-align: middle;"></div>-->
						<input class="button" type="submit" value="Delete" onClick="parent.location='index.php?delete-table[<?php echo $name; ?>]'" id="delete-table">
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>