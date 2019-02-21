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
				<a href="task-delete.php?id=<?php echo $task['id']; ?>">Delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
	
</table>