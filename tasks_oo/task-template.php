<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Task <?php echo $task["name"]; ?></h1>
    <p>
        <a href="index.php">Back to Task List</a>
    </p>

    <?php for ($i = 1; $i < count($task) -1; $i++) : ?>
        <p>
            <?php if (empty($task[$fields[$i]])) : ?>
                <?php continue; ?>
            <?php endif; ?>
            <strong><?php echo ucwords($colNames[$i]); ?>:</strong>
            <?php echo $task[$fields[$i]]; ?>
        </p>

    <?php endfor; ?>

    <h2>Attachments</h2>
    <!-- List -->
    <?php if (count($attachments) > 0) : ?>
        <table>
            <tr>
                <th>File</th>
                <th>Options</th>
            </tr>

            <?php foreach ($attachments as $attachment) : ?>
                <tr>
                    <td><?php echo $attachment["name"]; ?></td>
                    <td>
                        <a href="attachments/<?php echo $attachment["file"]; ?>">Download</a>

                        <a href="operations/delete_attachment.php?id=<?php echo $attachment['id']; ?>">Delete</a>

                        <!-- TODO: delete attachment -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>There are no attachments yet.</p>
    <?php endif; ?>

    <!-- Form -->
    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>New Attachment</legend>
            <input type="hidden" name="task-id" value="<?php echo $task['id']; ?>">

            <label>
                <span class="error"><?php displayError("attach"); ?></span>
                <input type="file" name="attachment">
            </label>

            <input type="submit" name="submit" value="Upload">
        </fieldset>
    </form>
</body>
</html>