<?php

$result = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $colors = array(
        "red",
        "blue"
    );

    $result = json_encode($colors);
}
echo $result;