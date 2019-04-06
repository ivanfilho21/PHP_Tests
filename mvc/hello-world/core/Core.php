<?php
define("DEFAULT_CONTROLLER", "HomeController");
define("DEFAULT_ACTION", "index");
define("DEFAULT_PARAMS", array(""));
class Core
{
	public function start()
	{
		$url = "/";
		$url .= (! empty($_GET["url"])) ? $_GET["url"] : "";

		echo "URL: " .$url ."<br><hr>";

		# get controller, action, and parameters from URL
		if (! empty($url) && $url !== "/") {
			$url = explode("/", $url);
			#print_r($url);

			# Get controller from url
			# removes first index from array
			array_shift($url);
			$currentController = ucfirst($url[0]) ."Controller";

			# Get action from url
			array_shift($url);
			#print_r($url);
			$currentAction = (isset($url[0]) && ! empty($url[0])) ? $url[0] : DEFAULT_ACTION;

			# Get parameters from url
			array_shift($url);
			#print_r($url);
			echo "length of url: " .count($url);
			$currentParams = (count($url) > 0) ? $url : DEFAULT_PARAMS;

		} else {
			# sets default Controller and action
			$currentController = DEFAULT_CONTROLLER;
			$currentAction = DEFAULT_ACTION;
			$currentParams = DEFAULT_PARAMS;
		}

		if (ENVIRONMENT == "debug") {
			echo "<br>";
			echo "Controller: " .$currentController ."<br>";
			echo (! empty($currentAction)) ? "Action: " .$currentAction ."<br>" : "<br>";
			echo "Parameters: ";
			print_r($currentParams) ."<br>";
			echo "<br><hr>";
		}

		# Instantiate controller using the variable $currentController
		$c = new $currentController();

		# Call action (function) from current controller
		# I can't do this:  $c->index(); works, but can't pass the parameters
		# call_user_func_array(array($c, $currentAction), $currentParams);
		call_user_func_array(array($c, $currentAction), array($currentParams));
	}
}