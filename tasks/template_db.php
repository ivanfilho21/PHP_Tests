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
					<input type="date" name="date_creation" value="<?php echo date("Y-m-d"); ?>" />
				</label>
				
				<label>
					Deadline:
					<input type="date" name="deadline" value="<?php echo date("Y-m-d"); ?>" />
				</label>
				
				<fieldset>
					<legend>Priority:</legend>
					<label>
						<input type="radio" name="priority" value="0" checked />Low
						<input type="radio" name="priority" value="1" />Medium		
						<input type="radio" name="priority" value="2" />High
					</label>
				</fieldset>
				
				<label>
					Description (Optional):
					<textarea name="description" ></textarea>
				</label>
				
				<label>
					<input type="checkbox" name="finished" value="1" />
					Task is Already Finished.
				</label>
				
				<div class="button">
					<input type="submit" value="Save Task" />
				</div>
			</fieldset>
		</form>
		
		<?php
			$task_list = get_tasks_from_db($connection);
			
			function get_tasks_from_db($connection)
			{
				$sql = "SELECT * FROM tasks";
				$res = mysqli_query($connection, $sql);
				$tasks = array();
				
				while ($t = mysqli_fetch_assoc($res))
				{
					$tasks[] = $t;
				}
				
				for ($i = 0; $i < count($tasks); $i++)
				{
					if ($tasks[$i]["finished"] == 0)
						$tasks[$i]["finished"] = "No";
					else
						$tasks[$i]["finished"] = "Yes";
					
					$value = "";
					switch ($tasks[$i]["priority"])
					{
						case 0: $value = "Low"; break; 
						case 1: $value = "Medium"; break; 
						case 2: $value = "High"; break; 
					}
					$tasks[$i]["priority"] = $value;
					
					$dateArray = explode("-", $tasks[$i]["date_creation"]);
					if (count($dateArray) > 1)
						$tasks[$i]["date_creation"] = $dateArray[2] . "/" . $dateArray[1] . "/" . $dateArray[0];
					
					$dateArray = explode("-", $tasks[$i]["deadline"]);
					if (count($dateArray) > 1)
						$tasks[$i]["deadline"] = $dateArray[2] . "/" . $dateArray[1] . "/" . $dateArray[0];
				}
				
				return $tasks;
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
				<?php foreach ($fields as $field) : ?>
					<td><?php echo $task[$field]; ?></td>
				<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			
		</table>
		
	</body>
</html>