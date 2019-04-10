<?php

class NotFound extends Controller
{
	public function __construct($database)
	{
		parent::__construct($database, "Page Not Found");
	}

	public function index()
	{
		$this->loadView("404", false);
	}
}