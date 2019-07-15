<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $a = array("0" => "aliceblue", "1" => "blue");
    echo json_encode($a, true);


    /*# echo json_encode(file_get_contents("colors.json"));
    // $json = file_get_contents("colors.json", true);
    $json = file_get_contents("colors.json", false);
    // echo json_encode(json_decode($json), JSON_PRETTY_PRINT);
    echo json_encode(json_decode($json));*/
}

echo "";