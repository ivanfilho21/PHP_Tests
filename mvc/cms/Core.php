<?php
define("UNDER_CONSTRUCTION_CONTROLLER", "UnderConstruction");
define("DEFAULT_ERROR_CONTROLLER", "NotFound");
define("DEFAULT_CONTROLLER", "Home");
define("DEFAULT_ACTION", "index");
define("DEFAULT_PARAMS", array(""));

class Core
{
	private $debugCore = true;

	public function __construct($debugCore = false)
	{
		$this->debugCore = $debugCore;
	}

	public function start($database)
	{
		$url = "/";
		$url .= (! empty($_GET["url"])) ? $_GET["url"] : "";

		if ($this->debugCore) echo "URL: " .$url ."<br><hr>";

		# get controller, action, and parameters from URL
		if ($url !== "/" && (! EXCEPTION)) {
			$url = explode("/", $url);
			if ($this->debugCore) print_r($url);

			# Get controller from url
			# removes first index from array, which is /
			array_shift($url);
			$cont = (strpos($url[0], ".php") !== false) ? substr($url[0], 0, - strlen(".php")) : $url[0];
			$currentController = ucfirst($cont);

			# Get action from url
			array_shift($url);
			if ($this->debugCore) print_r($url);

			if (isset($url[0]) && !empty($url[0])) {
				$act = (strpos($url[0], ".php") !== false) ? substr($url[0], 0, - strlen(".php")) : $url[0];
				$currentAction = (isset($act) && ! empty($act)) ? $act : DEFAULT_ACTION;
			} else {
				$currentAction = DEFAULT_ACTION;
			}

			# Get parameters from url
			array_shift($url);
			if ($this->debugCore) print_r($url);
			if ($this->debugCore) echo "<br>Length of url: " .count($url);
			$currentParams = (count($url) > 0) ? $url : DEFAULT_PARAMS;

		} elseif (defined("EXCEPTION") && EXCEPTION) {
			$currentController = UNDER_CONSTRUCTION_CONTROLLER;
			$currentAction = DEFAULT_ACTION;
			$currentParams = DEFAULT_PARAMS;
		} else {
			# sets default Controller and action
			$currentController = DEFAULT_CONTROLLER;
			$currentAction = DEFAULT_ACTION;
			$currentParams = DEFAULT_PARAMS;
		}

		if ($this->debugCore) {
			echo "<br>";
			echo "Controller: " .$currentController ."<br>";
			echo (! empty($currentAction)) ? "Action: " .$currentAction ."<br>" : "<br>";
			echo "Parameters: ";
			print_r($currentParams) ."<br>";
			echo "<br><hr>";
		}

		# Instantiate controller using the variable $currentController and calling action
		try {
			$c = $this->loadCurrentController($currentController, $database);				
		} catch(Exception $e) {
			if (defined("DEBUG") && DEBUG) {
				echo "<b>Core:</b> Controller \"{$currentController}\" does not exist."; die();
			} else {
				$currentController = DEFAULT_ERROR_CONTROLLER;
				$currentAction = DEFAULT_ACTION;
				
				$c = $this->loadCurrentController($currentController, $database);
			}
		}
		try {
			$this->callFunction($c, $currentAction, $currentParams);
		} catch(Exception $e) {
			if (defined("DEBUG") && DEBUG) {
				echo $e->getMessage(); die();
			} else {
				$currentAction = DEFAULT_ACTION;
				$this->callFunction($c, $currentAction, $currentParams);
			}
		}
	}

	private function loadCurrentController($currentController, $database)
	{
		if (class_exists($currentController)) {
			return new $currentController($database);
		}
		else {
			throw new Exception("<b>Core:</b> Controller <b>\"{$currentController}\"</b> does not exist.", 1);
		}
	}

	private function callFunction($className, $action, $params)
	{
		if (is_callable(array($className, $action))) {
			call_user_func_array(array($className, $action), $params);
		} else {
			throw new Exception("<b>Core:</b> Controller does not contain any action called <b>\"{$action}()\"</b>.", 1);
		}
	}
}