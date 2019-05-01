<?php include PATH ."scripts/list.php"; ?>

<h1>Task Manager</h1>

<?php include PATH ."pages/form.php"; ?>

<?php if (count($tasks) == 0) : ?>
<?php else : ?>
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
                <a href="#">Edit</a>
                <a href="<?php echo URL; ?>scripts/duplicate.php?id=<?php echo $task["id"]; ?>">Duplicate</a>
                <a href="<?php echo URL; ?>scripts/delete.php?id=<?php echo $task["id"]; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<hr>
<h4>Danger Zone</h4>
<a href="#">Delete All Tasks</a>
<?php endif ?>
