<?php

session_start();

require "../vendor/autoload.php";
use MongoDB\Client as MongoDB;

$conn = new MongoDB("mongodb://localhost:27017");