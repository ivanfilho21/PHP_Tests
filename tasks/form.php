<form method="POST">
    <fieldset>
        <legend>New Task</legend>

        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
        
        <label>
            Task Name (*):
            <input type="text" name="name" value="<?php echo $task['name']; ?>">
            <span class="error" style="color: coral;"><?php displayError("name"); ?></span>
        </label>
        
        <label>
            Created in:
            <input type="date" name="date_creation" value="<?php
            $d = date("Y-m-d", strtotime($task['date_creation']));
            echo (empty($task['date_creation'])) ? date("Y-m-d") : $d; ?>">
        </label>
        
        <label>
            Deadline:
            <input type="date" name="deadline" value="<?php
            $d = date("Y-m-d", strtotime($task['deadline']));
            echo (empty($task['deadline'])) ? date("Y-m-d") : $d; ?>">
        </label>
        
        <fieldset>
            <legend>Priority (*):</legend>
            <label>
                <input type="radio" name="priority" value="1" <?php echo ($task["priority"] == 1) ? "checked" : ""; ?>>Low
                <input type="radio" name="priority" value="2" <?php echo ($task["priority"] == 2) ? "checked" : ""; ?>>Medium       
                <input type="radio" name="priority" value="3" <?php echo ($task["priority"] == 3) ? "checked" : ""; ?>>High
            </label>
        </fieldset>
        
        <label>
            Description:
            <input type="text" name="description" value="<?php echo $task['description']; ?>"></textarea>
        </label>
        
        <label>
            <input type="checkbox" name="finished" <?php echo "value='" . $task["finished"] . "'"; if ($task["finished"]) echo "checked"; ?>>
            Task is Already Finished.
        </label>

        <div class="button">
            <input type="submit" value="Save Task">
        </div>

        <?php if (! $view_mode) : ?>
            <div class="button">
                <input type="submit" value="Cancel">
            </div>
        <?php endif; ?>
        
    </fieldset>
</form>