<?php

require_once './lib/global.php';

$controller = null;

switch (get("action")) {
    case "get":
        $controller = new controller\RetrieveImageController(get("id"));
        break;
    case "add":
        $controller = new controller\AddController($_POST);
        break;
    case "delete":
        $controller = new controller\DeleteController(get("id"));
        break;
    default:
        $controller = new controller\IndexController(get("letter"));
}

$controller->doAction();
