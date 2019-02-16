
<h1>Tables</h1>

<input type="submit" value="Create Table" onClick="parent.location='create-table.php'">

<table>
	
	<thead>
		<th>Name</th>
		<th>Action</th>
	</thead>

	<tbody>
		<?php foreach ($tables as $value) : ?>
			<?php foreach ($value as $name) : ?>
				
				<tr>
					<td>

						<a href=""><?php echo $name; ?></a>

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
						<input type="submit" value="Delete" onclick="" id="delete-table">
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>