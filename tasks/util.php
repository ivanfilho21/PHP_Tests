<?php
$fields = array("name", "date_creation", "deadline", "priority", "description", "finished");


function generateEmptyTask()
{
	$task = array(
		"id" => 0,
		"name" => "",
		"date_creation" => "",
		"deadline" => "",
		"priority" => 2,
		"description" => "",
		"finished" => ""
	);

	return $task;
}