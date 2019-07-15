<?php

$result = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $colors = array(
        "white", "lightgray", "gray", "lightgreen", "green", "darkslategray",
        "lightblue", "blue", "red", "gold", "crimson", "darkseagreen",
        "pink", "orange", "dodgerblue", "purple", "violet"
    );

    $result = json_encode($colors);
}
echo $result;