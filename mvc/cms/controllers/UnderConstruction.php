<?php
class UnderConstruction extends Controller
{
	public function __construct()
	{
		$this->title = "Under Construction";
		$this->viewName = "under-construction";
	}

	public function index()
	{
		$this->loadView("under-construction", false);
	}

}