<?php

session_start();

require_once "functions.php";

spl_autoload_register(function($classname) {
        $fileName = "./src/" . str_replace("\\", "/", $classname) . ".php";

         if(!is_readable($fileName)) {
             return false;
         }

         require_once $fileName;
         return true;
    }
);

require_once "routes.php";