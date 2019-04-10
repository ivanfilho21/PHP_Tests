<?php

class NotFound extends Controller
{
	public function __construct()
	{
		$this->title = "Page Not Found";
	}

	public function index()
	{
		$this->loadView("404", false);
	}
}