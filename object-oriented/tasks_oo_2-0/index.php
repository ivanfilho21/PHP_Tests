<?php include "config.php"; ?>
<?php include "pages/template/page-top.php"; ?>
<?php include "scripts/list.php"; ?>

<h1>Task Manager</h1>

<a href="pages/form.php">Create Task</a>

<?php if (count($tasks) == 0) : ?>
<?php else : ?>
    <?php #print_r($tasks); ?>
<table>
    <thead>
        <tr>
            <?php foreach ($fields as $field): ?>
            <th><?php echo $field; ?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?php echo $task["id"]; ?></td>

            <td><?php echo $task["name"]; ?></td>

            <td><?php echo $task["description"]; ?></td>

            <td><?php echo $task["date_creation"]; ?></td>

            <td><?php echo $task["deadline"]; ?></td>

            <td>
                <a target="_blank" href="attachments/<?php echo $task["attachment"]; ?>">View</a>
            </td>

            <td>
                <a href="pages/form.php?id=<?php echo $task["id"]; ?>">Edit</a>
                <a href="scripts/duplicate.php?id=<?php echo $task["id"]; ?>">Duplicate</a>
                <a href="scripts/delete.php?id=<?php echo $task["id"]; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<hr>
<h4>Danger Zone</h4>
<a href="#">Delete All Tasks</a>
<?php endif ?>
<?php include "pages/template/page-bottom.php"; ?>