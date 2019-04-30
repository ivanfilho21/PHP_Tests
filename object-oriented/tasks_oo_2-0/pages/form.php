<form method="POST">
    <fieldset>
        <legend>New Task</legend>
        <label>Task Name (*):</label>
        <input type="text" name="name">

        <label>Created In:</label>
        <input type="date" name="created">

        <label>Deadline:</label>
        <input type="date" name="deadline">

        <label>Priority</label>
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

        <input type="submit" name="save-task" value="Save Task">
    </fieldset>    
</form>