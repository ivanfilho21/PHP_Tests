<?php
$fields = array("name", "date_creation", "deadline", "priority", "description", "finished");

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
