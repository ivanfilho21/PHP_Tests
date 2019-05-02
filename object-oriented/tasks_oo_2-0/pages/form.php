<?php include PATH ."scripts/create.php"; ?>

<script src="assets/js/util.js"></script>
<form method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>New Task</legend>
        <label>Task Name (*):</label>
        <input type="text" name="name">

        <label>Created In:</label>
        <input type="date" name="created">

        <label>Deadline:</label>
        <input type="date" name="deadline">

        <label>Priority:</label>
        <input id="low-priority" type="radio" name="priority" value="1">
        <label for="low-priority">Low</label>

        <input id="med-priority" type="radio" name="priority" value="2" checked="on">
        <label for="med-priority">Medium</label>

        <input id="hig-priority" type="radio" name="priority" value="3">
        <label for="hig-priority">High</label>

        <label>Description:</label>
        <textarea cols="40"></textarea>

        <input id="task-finished" type="checkbox" name="finished">
        <label for="task-finished">Task is Finished</label>
    </fieldset>

    <fieldset>
        <legend>Attachments</legend>

        <div id="attachments" class="attachments"></div>

        <input id="files" type="file" multiple="off" name="attachment" onchange="updatePreviews.call(this)">
    </fieldset>

    <input type="submit" name="save-task" value="Save Task">
</form>