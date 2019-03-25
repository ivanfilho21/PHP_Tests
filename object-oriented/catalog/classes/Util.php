<?php

class Util
{
	public function __construct()
	{
		$errorMsg = array();
	}

	public function checkMethod($method)
	{
		return ($_SERVER["REQUEST_METHOD"] == $method);
	}

	public function formatHTMLInput($data)
	{
		if (isset($data)) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);

			return $data;
		}
		return "";
	}

	public function getErrorMessage($index)
	{
		return (isset($this->errorMsg[$index])) ? $this->errorMsg[$index] : "";
	}

	public function setErrorMessage($index, $message)
	{
		$this->errorMsg[$index] = $message;
	}
}