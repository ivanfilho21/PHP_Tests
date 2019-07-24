<?php

global $routers;
$routers = array();

$routers["/"] = "/home/index";
$routers["/index"] = "/home/index";
$routers["/index/"] = "/home/index";
$routers["/authentication"] = "/home/index";
$routers["/authentication/"] = "/home/index";

$routers["/login"] = "/authentication/login";
$routers["/login/"] = "/authentication/login";
$routers["/sign-in"] = "/authentication/login";
$routers["/sign-in/"] = "/authentication/login";
$routers["/register"] = "/authentication/register";
$routers["/register/"] = "/authentication/register";
$routers["/sign-up"] = "/authentication/register";
$routers["/sign-up/"] = "/authentication/register";

// $routers["/login/{id}"] = "/authentication/login/:id";