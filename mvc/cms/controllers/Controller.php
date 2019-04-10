<?php

abstract class Controller
{
	protected $title = "Catalog";
	protected $viewName = "";
	protected $viewData = array();

	public abstract function index();

	public function loadView($viewName, $loadFullPage=true)
	{
		#$viewName = (empty($viewName)) ? $this->viewName : $viewName;
		if ($loadFullPage)
			require "views/templates/default.php";
		else
			require "views/templates/blank.php";
	}

	private function loadViewIntoTemplate($viewName)
	{
		# transforms keys into variables
		extract($this->viewData);
		require "views/" .$viewName .".php";
	}
} 