<?php
if (! $userIsLogged)
{
	header("Location: " . $PATH . "index.php");
	die();
}