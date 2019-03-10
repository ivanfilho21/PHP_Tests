<?php 
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB);

if ($mysqli->connect_errno)
{
    echo "Error: There is a problem connecting to the database.";
    die();
}

function createDatabase($mysqli)
{
    $mysqli->query("CREATE DATABASE " . DB) or die("failed creating database with query: " . $sql);
}

function createTableTasks($mysqli)
{
    global $fields;
    $types = array("text", "date", "date", "int(1)", "text", "int(1)");
    $values = "id int not null auto_increment primary key, ";
    $comma = ", ";
    $size = count($fields);

    for ($i = 0; $i < $size; $i++)
    {
        $name = $fields[$i];
        $type = $types[$i];

        $values .= $name . " " . $type . $comma;
    }

    $values = substr($values, 0, strlen($values) - strlen($comma));

    $sql = "CREATE TABLE " . DB_TABLE_TASKS . " ({$values})";

    #echo $sql;
    $mysqli->query($sql) or die("failed creating table");
}

function createTableAttachments($mysqli)
{
    $sql = "CREATE TABLE " . DB_TABLE_ATTACHMENTS . " (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        task_id INT NOT NULL,
        name VARCHAR(255) NOT NULL,
        file VARCHAR(255) NOT NULL,
        FOREIGN KEY (task_id) REFERENCES tasks(id)
    )";

    $mysqli->query($sql) or die("failed creating table");
}