<?php

require "config.php";
$response = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (! empty($_GET["id"])) {
        $id = $_GET["id"];
        $list = $cakeDB->get($id);
        $list["recipe"] = htmlspecialchars_decode($list["recipe"]);

        for ($i = 0; $i < count($list); $i++) {
            unset($list[$i]);    
        }

        $response = $list;
    }
    else if (! empty($_GET["list"])) {
        $list = $cakeDB->getAll();

        for ($i = 0; $i < count($list); $i++) {
            for ($j = 0; $j < count($list[$i]); $j++) {
                unset($list[$i][$j]);
            }
            $list[$i]["recipe"] = htmlspecialchars_decode($list[$i]["recipe"]);
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

        $head[0] = "Id";
        $head[1] = "Name";
        $head[2] = "Recipe";

        $list["head"] = $head;
        $response = $list;
    }
}
// echo "<br>";
// echo '<pre>' . var_export($head, true) . '</pre>';
// die;

// echo json_encode($response, JSON_PRETTY_PRINT);
echo json_encode($response);