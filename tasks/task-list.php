<?php $task_list = get_tasks_from_db($connection); ?>
<?php if (count($task_list) == 0) die(); ?>
<table>
	
	<?php $col_names = array("Name", "Created In", "Deadline", "Priority", "Description", "Finished"); ?>
	<tr>
		<?php foreach ($col_names as $field) : ?>
				<th><?php echo $field; ?></th>
		<?php endforeach; ?>
		
		<th>Options</th>
	</tr>

	<?php foreach ($task_list as $task) : ?>
		<tr>
		<?php foreach ($fields as $field) : ?>
			<td><?php echo $task[$field]; ?></td>
		<?php endforeach; ?>

			<td>
				<a href="task-edit.php?id=<?php echo $task['id']; ?>">Edit</a>
				<a href="operations/delete.php?id=<?php echo $task['id']; ?>">Delete</a>
				<a href="operations/duplicate.php?id=<?php echo $task['id']; ?>">Duplicate</a>
			</td>
		</tr>
	<?php endforeach; ?>
	
</table>

<div class="hor-divider" style="width: 100%; margin: 12px auto; height: 1px; background: white;"></div>

<div style="text-align: center;">
	<h4>Danger Zone</h4>
	<a href="operations/delete.php?all=true" style="color: coral;">Delete All Tasks</a>
</div>