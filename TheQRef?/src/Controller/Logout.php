<?php

namespace Controller;

class Logout implements Controller {
    public function clear() {
        \Session\Session::destroy();
        redirect(\Routing\Route::get("empty")->generate());
    }
}
