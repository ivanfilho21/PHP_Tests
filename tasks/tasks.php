<html>
	<head>
		<title>Task Manager</title>
	</head>

	<body>
		<h1>Task Manager</h1>
		<!-- My code -->
		
		<form>
			<fieldset>
				<legend>New Task</legend>
				<label>
					Task:
					<input type="text" name="task_name" />
				</label>
				<input type="submit" value="Submit" />
			</fieldset>
		</form>
		
		<?php
			$task_list = array();
			
			if (isset($_GET['task_name']))
			{
				$task_list[] = $_GET['task_name'];
			}
		?>
		
		<table>
			<tr>
				<th>Your Task</th>
			</tr>
			
			<?php foreach ($task_list as $task) : ?>
				<tr>
					<td><?php echo $task; ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		
	</body>
</html>