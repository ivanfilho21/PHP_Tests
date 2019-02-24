<html>
	<head>
		<title>Task Manager</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<h1>Task Manager</h1>
		
		<?php include "form.php"; ?>

		<?php if ($view_mode) : ?>
			<?php $task_list = get_tasks_from_db($connection); ?>
			<?php if (count($task_list) > 0) : ?>
				<?php include "task-list.php"; ?>
			<?php endif; ?>
		<?php else : ?>
			<?php include "operations/cancel.php"; ?>
		<?php endif; ?>
	</body>
</html>