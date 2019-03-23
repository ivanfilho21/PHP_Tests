<?php
require "Contact.php";
require "util.php";

$contacts = new Contact();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = formatInput($_GET["id"]);
    
    if (! empty($id))
        $contacts->delete($id);
}
header("Location: index.php");
exit();