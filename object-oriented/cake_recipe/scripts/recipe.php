<?php

require "config.php";

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (! empty($_GET["list"])) {
        $list = $cakeDB->getAll();

        for ($i = 0; $i < count($list); $i++) {
            for ($j = 0; $j < count($list[$i]); $j++) {
                unset($list[$i][$j]);
            }
        }
        // echo "<br>";
        // echo '<pre>' . var_export($list, true) . '</pre>';

        $head = array();
        foreach ($list as $recipe) {
            foreach ($recipe as $key => $value) {
                $head[] = $key;
            }
            break;
        }

        $list["head"] = $head;
        $response = $list;
    }
}
// echo "<br>";
// echo '<pre>' . var_export($head, true) . '</pre>';
// die;

echo json_encode($response, JSON_PRETTY_PRINT);