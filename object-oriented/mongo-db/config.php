<?php

session_start();

require "src/class/DB.php";

$conn = DB::getConnection();