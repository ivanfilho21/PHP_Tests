<?php include "config.php"; ?>
<?php include "pages/template/page-top.php"; ?>
<?php include "scripts/list.php"; ?>

<a href="pages/form.php">Create Task</a>

<?php if (count($tasks) == 0) : ?>
<?php else : ?>

<button><i class="fa fa-check-double"></i> Check All</button>

<div class="table-options" style="display: none;">
    <button><i class="fa fa-calendar-check"></i> Mark as Finished</button>
    <button><i class="fa fa-trash"></i> Delete</button>
</div>

<table>
    <thead>
        <tr>
            <th></th>
            <?php foreach ($fields as $field): ?>
            <th><?php echo $field; ?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td>
                <input type="checkbox" name="select-row">
            </td>

            <td><?php echo $task["id"]; ?></td>

            <td>
                <a href="pages/view.php?id=<?php echo $task["id"]; ?>"><?php echo $task["name"]; ?></td></a>

            <td><?php echo $task["description"]; ?></td>

            <td><?php echo $task["priority"]; ?></td>

            <td><?php echo $task["date_creation"]; ?></td>

            <td><?php echo $task["deadline"]; ?></td>

            <td><?php echo count($task["attachments"]); ?></td>

            <td>
                <a href="pages/form.php?id=<?php echo $task["id"]; ?>">Edit</a>
                <a href="scripts/duplicate.php?id=<?php echo $task["id"]; ?>">Duplicate</a>
                <a href="scripts/delete.php?id=<?php echo $task["id"]; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php endif ?>
<?php include "pages/template/page-bottom.php"; ?>