<?php

$userIsLogged = false;
$loggedUserName = "";

# Removes some unimportant characters from the passed string.
function format_input( $data )
{
	$data = trim( $data ); # Removes additional blank spaces.
	$data = stripslashes( $data ); # Removes slashes (\);
	$data = htmlspecialchars( $data ); # Removes special characters.
	return $data;
}

# Checks empty fields from $_POST superglobal (username, password, and password_confirmation).
# Returns false if at least one field is empty, true otherwise.
function check_empty_fields( $fieldNames )
{
	global $error_msgs;
	$res = true;
	foreach ( $fieldNames as $field )
	{
		$value = format_input( $_POST[$field] );
		if (empty($value))
		{
			$error_msgs[$field] = "This field cannot be empty.";
			$res = false;
		}
	}
	return $res;
}

# Returns true if the username exists in the database, false otherwise.
function check_username( $name )
{
	global $connection;
	$users = get_users($connection);
	
	echo "my name: " . $name . "<br>";
	for ($i = 0; $i < count($users); $i++)
	{
		echo " Name: " . $users[$i]["username"];
		if ($users[$i]["username"] == $name)
			return true;
	}
	
	return false;
}