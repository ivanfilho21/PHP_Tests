<?php
session_start();
require "config.php";
require "autoload.php";

$core = new Core();
$core->start();