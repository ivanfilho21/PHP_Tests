<?php
class HomeController extends Controller
{
	public function index()
	{
		global $db;
		$testModel = new TestModel($db);
		
		$data = array("name" => "World", "var" => $testModel->getValue());

		$this->loadTemplate("home", $data);
	}

	public function test($params=array(""))
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