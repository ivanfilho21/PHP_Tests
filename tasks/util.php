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

# Get tasks from database and format some of the data to display in Task List.
function getTasksFromDB($connection)
{
    $tasks = getTaskList($connection);
    
    foreach ($tasks as $key => $task)
    {
        $tasks[$key] = translateTaskFields($task);
    }
    
    return $tasks;
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

function sendEmail($task, $attachments = array())
{
    include "libs/PHPMailer/PHPMailerAutoload.php";

    $emailBody = prepareEmailBody($task, $attachments);

    $email = new PHPMailer();

    $email->isSMTP();
    $email->Host = "smtp.gmail.com";
    $email->Port = 587;
    $email->SMTPSecure = "tls";
    $email->SMTPAuth = true;
    $email->Username = "ivanfilho21@gmail.com";
    $email->Password = "batata123";
    $email->setFrom("ivanfilho21@gmail.com", "Task Notifier");
    $email->addAddress(EMAIL);
    $email->Subject = "Notification of Task \"{$task['name']}\"";
    $email->msgHTML($emailBody);

    # Add Attachments
    foreach ($attachments as $attachment) {
        $email->addAttachment("attachments/{$attachment['file']}");
    }

    $email->send();
}

function prepareEmailBody()
{
    # get processed content from 'email_tamplate.php'

    # tells PHP not to send processing to browser
    ob_start();

    include "email-template.php";

    # store 'email template' content inside a variable
    $body = ob_get_contents();

    # tells PHP that browser can now receive contents
    ob_end_clean();

    return $body; 
}