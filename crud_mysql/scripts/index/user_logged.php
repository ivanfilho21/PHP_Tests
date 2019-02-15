
<input type="submit" value="Create Table" onClick="parent.location='create-table.php'">

<?php foreach ($tables as $value) : ?>
	<?php foreach ($value as $name) : ?>

		<h4><?php echo $name; ?></h4>

		<div class="table-holder">
			<input type="submit" value="-" onclick="" id="delete-row">
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
		</div>

	<?php endforeach; ?>
<?php endforeach; ?>