<?php

namespace Controller;

use View\HomeView;
use View\NavigationBarView;

class Home implements Controller {
    public function display() {
        $view = new HomeView("home");
        $view->addParam("navigation_bar_view", "\View\NavigationBarView");
        $view->outputHTML();
    }
}
