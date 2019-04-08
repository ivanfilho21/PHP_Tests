<?php

abstract class Controller
{
	protected $title = "Catalog";
	protected $viewName = "";
	protected $viewData = array();

	public abstract function index();

	public function loadView($viewName="")
	{
		$viewName = (empty($viewName)) ? $this->viewName : $viewName;
		require "views/template/template.php";
	}

	private function loadViewInTemplate($viewName)
	{
		# transforms keys into variables
		extract($this->viewData);

		require "views/" .$viewName .".php";
	}
} 