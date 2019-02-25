<?php
if (! $userIsLogged)
{
	#header("Location: README.md");
	header("Location: index.php");
	die();
}