<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="tasks_db.php"><h1>Task Manager</h1></a>
    
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