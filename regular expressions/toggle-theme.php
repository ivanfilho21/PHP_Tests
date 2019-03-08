<?php
$dark_theme = false;

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    # Request from Javascript (AJAX) to toggle theme
    if (isset($_REQUEST["theme"])) {
        $req = $_REQUEST["theme"];

        session_start();
        $_SESSION["dark-theme"] = ! $req;
        
        /*
        if (isset($_SESSION["dark-theme"])) {
            $_SESSION["dark-theme"] = ! $_SESSION["dark-theme"];
        }
        else {
            $_SESSION["dark-theme"] = true;
        } */

        echo $_SESSION["dark-theme"];
        die();
    }
    else {
    	#echo "<br>noooooooooooooooooooooooooooooooooooo";
    }
}
else {
	#echo "<br>noooooooooooooooooooooooooooooooooooo";
}

if (isset($_SESSION["dark-theme"]))
{
    $dark_theme = $_SESSION["dark-theme"];
}