<?php
class Home extends Controller
{
	public function __construct($database)
	{
		parent::__construct($database, "Home");
	}

	public function index()
	{
		global $database;
		$this->loadView("home");
	}
}