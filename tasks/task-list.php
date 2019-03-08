<table>
    
    <tr>
        <?php foreach ($colNames as $field) : ?>
                <th><?php echo $field; ?></th>
        <?php endforeach; ?>
        <th>Options</th>
    </tr>

    <?php foreach ($task_list as $task) : ?>
        <tr>
        <?php foreach ($fields as $field) : ?>
            <td>
                <?php if ($field == "name") : ?>
                    <a href="task.php?id=<?php echo $task["id"]; ?>">
                        <?php echo $task[$field]; ?>
                    </a>
                <?php else : ?>
                    <?php echo $task[$field]; ?>
                <?php endif; ?>
            </td>
        <?php endforeach; ?>

            <td>
                <a href="task-edit.php?id=<?php echo $task['id']; ?>">Edit</a>
                <a href="operations/delete.php?id=<?php echo $task['id']; ?>">Delete</a>
                <a href="operations/duplicate.php?id=<?php echo $task['id']; ?>">Duplicate</a>
            </td>
        </tr>
    <?php endforeach; ?>
    
</table>

<div class="hor-divider" style="width: 100%; margin: 12px auto; height: 1px; background: white;"></div>

<div style="text-align: center;">
    <h4>Danger Zone</h4>
    <a href="operations/delete.php?all=true" style="color: coral;">Delete All Tasks</a>
</div>