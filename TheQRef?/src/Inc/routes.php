<?php

\Routing\Route::register("empty", new \Routing\DefaultRoute("",
    ["controller" => "Index", "action" => "display"]));

\Routing\Route::register("register", new \Routing\DefaultRoute("register",
    ["controller" => "Register", "action" => "display"]));

\Routing\Route::register("home", new \Routing\DefaultRoute("home",
    ["controller" => "Home", "action" => "display"]));

\Routing\Route::register("logout", new \Routing\DefaultRoute("logout",
    ["controller" => "Logout", "action" => "clear"]));

\Routing\Route::register("account", new \Routing\DefaultRoute("account",
    ["controller" => "Account", "action" => "display"]));

\Routing\Route::register("create", new \Routing\DefaultRoute("create",
    ["controller" => "CreateQuiz", "action" => "display"]));

\Routing\Route::register("write", new \Routing\DefaultRoute("create/write/<id>",
    ["controller" => "RegisterQuiz", "action" => "display"], ["id" => "\d+"]));

\Routing\Route::register("save", new \Routing\DefaultRoute("create/save/<id>",
    ["controller" => "RegisterQuiz", "action" => "save"], ["id" => "\d+"]));

\Routing\Route::register("list", new \Routing\DefaultRoute("list",
    ["controller" => "QuizList", "action" => "display"]));

\Routing\Route::register("comments", new \Routing\DefaultRoute("comments/<id>",
    ["controller" => "Comments", "action" => "display"], ["id" => "\d+"]));

\Routing\Route::register("statistics", new \Routing\DefaultRoute("statistics",
    ["controller" => "Statistics", "action" => "display"]));

\Routing\Route::register("statistics", new \Routing\DefaultRoute("statistics",
    ["controller" => "Statistics", "action" => "display"]));

\Routing\Route::register("play", new \Routing\DefaultRoute("play",
    ["controller" => "Play", "action" => "display"]));

\Routing\Route::register("error", new \Routing\DefaultRoute("e404",
    ["controller" => "Error", "action" => "display"]));