<?php
require "Contact.php";
require "util.php";

$contacts = new Contact();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = formatInput($_POST["id"]);
    $name = formatInput($_POST["name"]);
    $email = formatInput($_POST["email"]);

    $contact["name"] = $name;
    $contact["email"] = $email;

    if (empty($email)) {
        # TODO: show error
    }
    else {
        $contacts->update($contact, $id);
    }       
    
    
}
header("Location: index.php");
exit();