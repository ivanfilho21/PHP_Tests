<?php
require "Calculator.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$n1 = (isset($_GET["n1"])) ? $_GET["n1"] : 0;
	$n2 = (isset($_GET["n2"])) ? $_GET["n2"] : 0;

	$op = (isset($_GET["op"])) ? $_GET["op"] : 0;

	if (ctype_digit($n1) && ctype_digit($n2) && ! empty($op)) {

		$calc = new Calculator();
		
		echo call_user_func_array(array($calc, $op), array($n1, $n2));
	}
	else
		echo "error";

}