<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Task Manager</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<h1>Task Manager</h1>
	
	<?php include "form.php"; ?>

	<?php if ($view_mode) : ?>
		<?php $task_list = getTasksFromDB($connection); ?>
		<?php if (count($task_list) > 0) : ?>
			<?php include "task-list.php"; ?>
		<?php endif; ?>
	<?php else : ?>
		<?php include "operations/cancel.php"; ?>
	<?php endif; ?>
</body>
</html>