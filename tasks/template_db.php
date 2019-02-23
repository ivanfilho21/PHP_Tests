<html>
	<head>
		<title>Task Manager</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<h1>Task Manager</h1>
		
		<?php include "form.php"; ?>

		<?php if ($view_mode) : ?>
			<?php include "task-list.php"; include "operations/cancel.php"; ?>
		<?php endif; ?>
		
		
	</body>
</html>