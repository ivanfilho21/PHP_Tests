<?php

class Util
{
	public function __construct()
	{
		$this->errorMsg = array();
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

	public function getErrorMessageArray()
	{
		return $this->errorMsg;
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