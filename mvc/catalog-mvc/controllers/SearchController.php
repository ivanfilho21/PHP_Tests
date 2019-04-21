<?php
class SearchController extends Controller
{
	public function __construct()
	{
		$this->title = "Search";
		$this->viewName = "search";
		$this->viewData = array(); 
	}

	public function index()
	{
		global $database;
		require "./scripts/" .$this->viewName ."/" .$this->viewName .".php";

		$this->viewData["results"] = $results;
		$this->loadView();
	}
}