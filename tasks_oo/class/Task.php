<?php
class Task
{
    public $mysqli;
    public $taskList = array();
    public $task = array();
    public $attachments = array();

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function getTaskListFromDB()
    {
        $sql = "SELECT * FROM " . DB_TABLE_TASKS;
        $res = $this->mysqli->query($sql);
        $this->taskList = array();

        if ($res == false) {
            return;
        }

        while ($t = mysqli_fetch_assoc($res)) {
            $this->taskList[] = $t;
        }
    }

    public function getTaskFromDB($id)
    {
        $sql = "SELECT * FROM " . DB_TABLE_TASKS . " WHERE id = '{$id}'";
        $res = $this->mysqli->query($sql);
        
        if ($res == false) {
            echo "<strong>Failed getting task from Database.</strong>";
            return;
        }
        $this->task = mysqli_fetch_assoc($res);
    }

    function saveTaskInDB($task, $fields)
    {
        $values = "";
        $comma = ", ";
        $qt = "'";
        
        foreach ($fields as $f) {       
            $values .= $qt . $task[$f] . $qt . $comma;
        }

        $values = substr($values, 0, strlen($values) - strlen($comma));
        # echo $values;
        
        $sql = "
            INSERT INTO " . DB_TABLE_TASKS .
            "(name, date_creation, deadline, priority, description, finished)
            VALUES ({$values})
        ";
        #echo $sql;
        
        $this->mysqli->query($sql) or die("Query Failed. Wrong statement or <strong>table doesn't exist</strong>.<br><br>SQL Query: " . $sql);
    }

    function editTaskInDB($task, $fields)
    {
        $values = "";
        $comma = ", ";

        foreach ($fields as $field) {
            $values .= $field . " = '{$task[$field]}'" . $comma;
        }
        $values = substr($values, 0, strlen($values) - strlen($comma));

        $id = $task["id"];
        $sql = "UPDATE " . DB_TABLE_TASKS . " SET {$values} WHERE id = '{$id}'";

        #echo $sql;
        $this->mysqli->query($sql) or die("Query Failed. Wrong statement or <strong>table doesn't exist</strong>.<br><br>SQL Query: ");
    }

    function deleteTaskFromDB($id)
    {
        $sql = "DELETE FROM " . DB_TABLE_TASKS . " WHERE id = '{$id}'";
        $this->mysqli->query($sql);
    }

    function deleteAllTasksFromDB()
    {
        $sql = "DROP TABLE " .  DB_TABLE_TASKS;
        $this->mysqli->query($sql) or die("Error in " . $sql);

        createTableTasks($this->mysqli);
    }

    function addAttachmentToTaskInDB($att)
    {
        $sql = "INSERT INTO " . DB_TABLE_ATTACHMENTS . " (task_id, name, file) VALUES ({$att['task_id']}, '{$att['name']}', '{$att['file']}')";

        $this->mysqli->query($sql) or die("Error in query: " . $sql);
    }

    function getAttachmentsFromDB($taskId)
    {
        $sql = "SELECT * FROM " . DB_TABLE_ATTACHMENTS . " WHERE task_id = {$taskId}";
        $res = $this->mysqli->query($sql);

        if ($res == false)
            return;

        $this->attachments = array();
        while ($att = mysqli_fetch_assoc($res)) {
            $this->attachments[] = $att;
        }
    }

    function deleteAttachmentFromDB($id)
    {
        $sql = "DELETE FROM " . DB_TABLE_ATTACHMENTS . " WHERE id = {$id}";
        $this->mysqli->query($sql) or die("Error in query: " . $sql);
    }

}