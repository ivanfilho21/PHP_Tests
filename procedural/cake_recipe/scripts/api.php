<?php

// echo "<pre>" .var_export($_SERVER, true) ."</pre>";

# Get the HTTP method, path, and body of the request
$method = $_SERVER["REQUEST_METHOD"];
$request = empty($_SERVER["PATH_INFO"]) ? array() : explode("/", trim($_SERVER["PATH_INFO"], "/"));
$input = json_decode(file_get_contents("php://input"), true);
$input = empty($input) ? array() : $input;

# Connect to the MYSQL database
$conn = mysqli_connect("localhost", "root", "", "cake_recipe_db");
mysqli_set_charset($conn, "utf8");

# Retrieve the table and key from the path
$pattern = "/[^a-z0-9_]+/i";
$table = preg_replace($pattern, "", array_shift($request));
$key = array_shift($request) + 0;

# Escape the columns and values from the input object
$columns = empty($input) ? array() : preg_replace($pattern, "", array_keys($input));
$values = array_map(function ($value) use ($conn) {
    return $value === null ? null : mysqli_real_escape_string($conn, (string)$value); }, array_values($input));

# Build the SET part of the SQL command
$set = "";

for ($i=0; $i < count($columns); $i++) { 
    $set .= ($i > 0 ? "," : "") . "`" .$columns[$i] ."` = ";
    $set .= ($values[$i] === null ? "NULL" : "\"" .$values[$i] ."\"");
}

# Create SQL based on HTTP method
switch ($method) {
    case "GET":
        $sql = "SELECT * FROM `$table`" .($key ? " WHERE id = $key" : "");
        break;
    case "PUT":
        $sql = "UPDATE `$table` SET $set WHERE id = $key";
        break;
    case "POST":
        $sql = "INSERT INTO `$table` SET $set";
        break;
    case "DELETE":
        $sql = "DELETE FROM `$table` WHERE id = $key";
        break;
}

# Execute SQL statement
$res = mysqli_query($conn, $sql);

# Die if SQL statement failed
if (! $res) {
    http_response_code(404);
    die(mysqli_error($conn));
}

# Print results, insert id or affected row count
if ($method == "GET") {
    $rows = mysqli_num_rows($res);
    $obj = array();

    if ($rows > 1) {
        for ($i = 0; $i < $rows; $i++) {
            $o = mysqli_fetch_object($res);
            $obj[] = $o;
        }
    } elseif ($rows == 1) {
        $obj = mysqli_fetch_object($res);
    }

    echo json_encode($obj);

    /*if (! $key) echo "[";
    for ($i=0; $i < mysqli_num_rows($res); $i++) {
        echo ($i > 0 ? "," : "") .json_encode(mysqli_fetch_object($res));
    }
    if (! $key) echo "]";*/
} elseif ($method == "POST") {
    echo mysqli_insert_id($conn);
} else {
    echo mysqli_affected_rows($conn);
}

# Close MYSQL connection
mysqli_close($conn);