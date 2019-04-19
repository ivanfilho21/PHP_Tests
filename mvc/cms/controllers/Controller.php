<?php
abstract class Controller
{
	protected $util;
	protected $auth;
	protected $database;
	protected $title = "Catalog";
	protected $siteConfig = array();

	public function __construct($database, $title, $viewData=array())
	{
		$this->database = $database;
		$this->util = new Util();
		$this->auth = new Authentication($this->database, $this->util);
		$this->title = $title;
		$this->viewData = $viewData;
		$this->siteConfig = $this->database->siteConfig->get();
	}

	public abstract function index();

	public function loadView(string $viewName, array $viewData=array(), string $templateName="")
	{
		if (!empty ($templateName)) {
			if (file_exists("views/templates/" .$templateName .".php")) {
				require "views/templates/" .$templateName .".php";
			}
		} else {
			require "views/templates/" .$this->siteConfig["template"] .".php";
		}
	}

	private function loadViewIntoTemplate($viewName, $viewData="")
	{
		# convert array keys into variables
		if (! empty($viewData))
			extract($viewData);
		require "views/" .$viewName .".php";
	}

	private function loadMenu()
	{
		$menu = $this->database->menus->getAll();
		$this->loadViewIntoTemplate("menu", array("menu" => $menu));
	}

	private function loadCrudTable($name, $url, $list, $columns)
	{
		$data = array("name" => $name, "list" => $list, "columns" => $columns, "url" => $url);
		$this->loadViewIntoTemplate("table", $data);
	}
} 