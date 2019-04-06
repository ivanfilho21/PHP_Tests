<?php
class HomeController extends Controller
{
	public function index()
	{
		echo "Hello World";
	}

	public function test($params)
	{
		echo "Test action.<br>";
		if (! empty($params)) {
			echo "PARAMS: ";

			$str = "";
			foreach ($params as $key => $value) {
				$str .= $value .", ";
			}

			echo substr($str, 0, -strlen(", ")) . ".";
		}
	}
}