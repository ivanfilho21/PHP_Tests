<h1>Task <?php echo $task["name"]; ?></h1>
<p>
    <a href="tasks_db.php">Back to Task List</a>
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

<?php if (count($attachments) > 0) : ?>
	<p><strong>Attention!</strong> This task contains attachments.</p>
<?php endif; ?>