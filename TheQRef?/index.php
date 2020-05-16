<?php

require_once "src/Inc/global.php";


try {
    \Dispatch\DefaultDispatcher::getInstance()->dispatch();
} catch (\Routing\RoutingException $e) {
    redirect(\Routing\Route::get('e404')->generate());
}

