<?php
class UnderConstructionController extends Controller
{
	public function __construct($database)
	{
		parent::__construct($database, "Under Construction");
	}

	public function index()
	{
		$this->loadView("under-construction", false);
	}

}