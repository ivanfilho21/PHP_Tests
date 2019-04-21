<?php

function autoLoad() {
	spl_autoload_register(function($class) {
	    require "classes/" .$class. ".php";
	});
}

function formatInput($data)
{
    if (isset($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    return "";
}