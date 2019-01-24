<?php session_start(); ?>
<html>
	<head>
		<title>Task Manager</title>
		<link rel="stylesheet" type="text/css" href="style.css">
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
			if (isset($_GET['task_name']))
			{
				$_SESSION['task_list'][] = $_GET['task_name'];
			}
		
			$task_list = array();
			
			if (isset($_SESSION['task_list']))
			{
				$task_list = $_SESSION['task_list'];
			}
		?>
		
		<table>
			<tr>
				<th>Created Tasks</th>
			</tr>
			
			<?php foreach ($task_list as $task) : ?>
				<tr>
					<td><?php echo $task; ?></td>
				</tr>
			<?php endforeach; ?>
			
		</table>
		
	</body>
</html>