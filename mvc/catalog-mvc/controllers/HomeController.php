<?php
class HomeController extends Controller
{
	public function __construct()
	{
		$this->viewName = "home";
		$this->viewData = array(); 
	}

	public function index()
	{
		$this->loadView("home");
	}
}