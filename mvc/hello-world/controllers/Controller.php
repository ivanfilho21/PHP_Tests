<?php

abstract class Controller
{
	public abstract function index();

	public function loadTemplate($viewName, $viewData=array())
	{
		# transforms keys into variables
		extract($viewData);

		require "views/template.php";
	}

	private function loadViewInTemplate($viewName, $viewData=array())
	{
		# transforms keys into variables
		extract($viewData);

		require "views/" .$viewName .".php";
	}
} 