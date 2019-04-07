<?php

abstract class Controller
{
	protected $viewName = "";
	protected $viewData = array();

	public abstract function index();

	public function loadView()
	{
		$viewName = $this->viewName;
		require "views/template/template.php";
	}

	private function loadViewInTemplate()
	{
		# transforms keys into variables
		extract($this->viewData);

		require "views/" .$this->viewName .".php";
	}
} 