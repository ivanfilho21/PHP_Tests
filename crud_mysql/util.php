<?php

$userIsLogged = false;
$loggedUserName = "";

# Removes some unimportant characters from the passed string.
function format_input($data)
{
	$data = trim($data); # Removes additional blank spaces.
	$data = stripslashes($data); # Removes slashes (\);
	$data = htmlspecialchars($data); # Removes special characters.
	return $data;
}

# Returns false if at least one field is empty in super global $_POST variable, true otherwise.
function checkEmptyFields($fieldNames)
{
	global $error_msgs;
	$res = true;
	foreach ($fieldNames as $field)
	{
		if (! isset($_POST[$field])) continue;

		$value = format_input($_POST[$field]);
		if (empty($value))
		{
			$error_msgs[$field] = "This field cannot be empty.";
			$res = false;
		}
	}
	return $res;
}

# Shows the error message for the given Field
function showError($field)
{
	global $error_msgs;
	if (isset($error_msgs[$field]))
		echo $error_msgs[$field];
}