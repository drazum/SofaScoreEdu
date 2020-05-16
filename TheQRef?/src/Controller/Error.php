<?php

namespace Controller;

use View\ErrorView;

class Error implements Controller{
    public function display() {
        $view = new ErrorView("error");
        $view->outputHTML();
    }
}
