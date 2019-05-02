<?php $scripts = array("util"); ?>
<?php include "../config.php"; ?>
<?php include "../pages/template/page-top.php"; ?>
<?php include "../scripts/create.php"; ?>
<script src="assets/js/util.js"></script>

<h1>New Task</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>New Task</legend>
        <label>Task Name (*):</label>
        <input type="text" name="name" value="<?php echo $task["name"]; ?>">
        <span class="error"><?php getErrorMessage("name"); ?></span>

        <label>Created In:</label>
        <input type="date" name="created" value="<?php echo $task["date_creation"]; ?>">

        <label>Deadline:</label>
        <input type="date" name="deadline" value="<?php echo $task["deadline"]; ?>">

        <label>Priority:</label>
        <input id="low-priority" type="radio" name="priority" value="1" <?php echo ($task["priority"] == "1") ? "checked" : ""; ?>>
        <label for="low-priority">Low</label>

        <input id="med-priority" type="radio" name="priority" value="2" checked>
        <label for="med-priority">Medium</label>

        <input id="hig-priority" type="radio" name="priority" value="3" <?php echo ($task["priority"] == "3") ? "checked" : ""; ?>>
        <label for="hig-priority">High</label>

        <label>Description:</label>
        <textarea name="description" cols="40"><?php echo $task["description"]; ?></textarea>

        <input id="task-finished" type="checkbox" name="finished" <?php echo ($task["finished"] == "1") ? "checked" : ""; ?>>
        <label for="task-finished">Task is Finished</label>
    </fieldset>

    <fieldset>
        <legend>Attachment</legend>

        <div id="attachment" class="attachment"></div>

        <input type="file" multiple="off" name="attachment" onchange="updatePreviews.call(this)">
    </fieldset>

    <input type="submit" name="save-task" value="Save Task">
</form>
<?php include "pages/template/page-bottom.php"; ?>