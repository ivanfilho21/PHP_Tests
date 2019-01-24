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
					Task Name:
					<input type="text" name="task_name" />
				</label>
				
				<label>
					Author:
					<input type="text" name="author" />
				</label>
				
				<label>
					Created in:
					<input type="text" name="creation" />
				</label>
				
				<input type="submit" value="Save Task" />
			</fieldset>
		</form>
		
		<?php
			if (isset($_GET['task_name']))
			{
				$_SESSION['tasks'][] = $_GET['task_name'];
			}
			
			if (isset($_GET['author']))
			{
				$_SESSION['authors'][] = $_GET['author'];
			}
			
			if (isset($_GET['creation']))
			{
				$_SESSION['dates'][] = $_GET['creation'];
			}
		
			$task_list = array();
			$author_list = array();
			$date_list = array();
			
			if (isset($_SESSION['tasks']))
			{
				$task_list = $_SESSION['tasks'];
			}
			
			if (isset($_SESSION['authors']))
			{
				$author_list = $_SESSION['authors'];
			}
			
			if (isset($_SESSION['dates']))
			{
				$date_list = $_SESSION['dates'];
			}
			
			# Debugging
			/*
			echo "<h2>Tasks: " . count($task_list);
			echo ". Authors: " . count($author_list);
			echo ". Dates: " . count($date_list) . ".</h2>";*/
		?>
		
		<?php
			$col_names = array("Task Name", "Author", "Created In");
		?>
		
		<table>
			<tr>
			<?php foreach ($col_names as $name)  : ?>
				<th><?php echo $name; ?></th>
			<?php endforeach; ?>
			</tr>
			
			<?php for ($i = 0; $i < count($task_list); $i++) : ?>
				<tr>
					<td><?php echo $task_list[$i]; ?></td>
					<td><?php echo $author_list[$i]; ?></td>
					<?php if (isset($date_list[$i])) : ?>
						<td><?php echo $date_list[$i]; ?></td>
					<?php else : ?>
						<td><?php echo " - "; ?></td>
					<?php endif; ?>
				</tr>
			<?php endfor; ?>
			
		</table>
		
	</body>
</html>