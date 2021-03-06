<?php
$fields = array("name", "date_creation", "deadline", "priority", "description", "finished");
$colNames = array("Name", "Created In", "Deadline", "Priority", "Description", "Finished");

function postSet()
{
    if (count($_POST) > 0)
        return true;
    return false;
}

# Outputs an error message if it exists in the specified index.
function displayError($index)
{
    global $validationErrors;

    if (isset($validationErrors[$index]))
        echo $validationErrors[$index];
}

function translateTaskFields($task)
{
    if ($task["finished"])
        $task["finished"] = "Yes";
    else
        $task["finished"] = "No";
    
    $value = "";
    switch ($task["priority"])
    {
        case 1: $value = "Low"; break; 
        case 2: $value = "Medium"; break; 
        case 3: $value = "High"; break; 
    }
    $task["priority"] = $value;
    
    $dateArray = explode("-", $task["date_creation"]);
    if (count($dateArray) > 1)
        $task["date_creation"] = $dateArray[2] . "/" . $dateArray[1] . "/" . $dateArray[0];
    
    $dateArray = explode("-", $task["deadline"]);
    if (count($dateArray) > 1)
        $task["deadline"] = $dateArray[2] . "/" . $dateArray[1] . "/" . $dateArray[0];

    return $task;
}