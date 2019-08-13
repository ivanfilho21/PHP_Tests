<?php

global $routers;
$routers = array();

$routers["/"] = "/home/index";
$routers["/index"] = "/home/index";
$routers["/index/"] = "/home/index";
$routers["/authentication"] = "/home/index";
$routers["/authentication/"] = "/home/index";

$routers["/board/{id}"] = "/board/open/:id";
$routers["/board/{id}/"] = "/board/open/:id";

$routers["/logout"] = "/authentication/logout";
$routers["/logout/"] = "/authentication/logout";
$routers["/sign-out"] = "/authentication/logout";
$routers["/sign-out/"] = "/authentication/logout";
$routers["/login"] = "/authentication/login";
$routers["/login/"] = "/authentication/login";
$routers["/sign-in"] = "/authentication/login";
$routers["/sign-in/"] = "/authentication/login";
$routers["/register"] = "/authentication/register";
$routers["/register/"] = "/authentication/register";
$routers["/sign-up"] = "/authentication/register";
$routers["/sign-up/"] = "/authentication/register";

// $routers["/login/{id}"] = "/authentication/login/:id";