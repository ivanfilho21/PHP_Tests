<?php

abstract class Controller
{
	protected $database;
	protected $title = "Catalog";
	protected $viewData = array();
	protected $siteConfig = array();

	public function __construct($database, $title, $viewData=array())
	{
		$this->database = $database;
		$this->title = $title;
		$this->viewData = $viewData;
		$this->siteConfig = $this->database->siteConfig->get();
	}


	public abstract function index();

	public function loadView($viewName, $loadTemplate=true)
	{
		if ($loadTemplate) {
			require "views/templates/" .$this->siteConfig["template"] .".php";
		} else {
			require "views/templates/blank.php";
		}
	}

	private function loadViewIntoTemplate($viewName)
	{
		# transforms keys into variables
		extract($this->viewData);
		require "views/" .$viewName .".php";
	}
} 