<?php
abstract class Model
{
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
}