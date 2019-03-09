<?php
class Task
{
    public $mysqli;
    public $taskList = array();
    public $task = array();

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
            return array();
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

}