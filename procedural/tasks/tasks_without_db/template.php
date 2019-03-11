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
					<input type="text" name="name" />
				</label>
				
				<label>
					Created in:
					<input type="text" name="date_of_creation" />
				</label>
				
				<label>
					Deadline:
					<input type="text" name="deadline" />
				</label>
				
				<fieldset>
					<legend>Priority:</legend>
					<label>
						<input type="radio" name="priority" value="low" checked />
						Low
						
						<input type="radio" name="priority" value="medium" />
						Medium
						
						<input type="radio" name="priority" value="high" />
						High
					</label>
				</fieldset>
				
				<label>
					Description (Optional):
					<textarea name="description" ></textarea>
				</label>
				
				<label>
					<input type="checkbox" name="finished" value="yes" />
					Task is Already Finished.
				</label>
				
				<div class="button">
					<input type="submit" value="Save Task" />
				</div>
			</fieldset>
		</form>
		
		<?php
			$task_list = array();
			
			if (isset($_SESSION['tasks']))
			{
				$task_list = $_SESSION['tasks'];
			}
		?>
		
		<?php if (count($task_list) == 0) return; ?>
		<table>
			<?php $col_names = array("Name", "Created In", "Deadline", "Priority", "Description", "Finished"); ?>
			<tr>
			<?php foreach ($col_names as $field) : ?>
				<th><?php echo $field; ?></th>
			<?php endforeach; ?>
			</tr>
			
			<?php foreach ($task_list as $task) : ?>
				<tr>
				<?php foreach ($fields as $field)  : ?>
					<td><?php echo $task[$field]; ?></td>
				<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			
		</table>
		
	</body>
</html>