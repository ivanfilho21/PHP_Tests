<?php
class Home extends Controller
{
	public function __construct()
	{
		$this->title = "Home";
		$this->viewData = array(); 
	}

	public function index()
	{
		global $database;
		$this->loadView("home");
	}
}