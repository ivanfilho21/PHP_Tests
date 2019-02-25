<?php include "scripts/crud/delete_table.php"; ?>

<h1 style="margin-bottom: 1em; ">Tables</h1>

<input class="button" id="create-table" type="submit" value="Create Table" onclick="parent.location='crud/create-table.php'">

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
					</td>

					<td>
						<input class="button" id="read-table" type="submit" value="Read" onclick="parent.location='crud/view-table.php?table[<?php echo $name; ?>]'">
						
						<div style="display: inline-block; height: 16px; border-left: 1px solid #a09d9d; vertical-align: middle;"></div>
						
						<input class="button" id="update-table" type="submit" value="Update" onclick="parent.location='crud/update-table.php?table[<?php echo $name; ?>]'">
						
						<div style="display: inline-block; height: 16px; border-left: 1px solid #a09d9d; vertical-align: middle;"></div>
						
						<input class="button" id="delete-table" type="submit" value="Delete" onclick="parent.location='index.php?delete-table[<?php echo $name; ?>]'">
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>