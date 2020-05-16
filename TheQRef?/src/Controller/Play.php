<?php

namespace Controller;

use View\PlayView;

class Play implements Controller {
    public function display(){
        $view = new PlayView("play");
        $view->addParam("navigation_bar_view", "\View\NavigationBarView");
        $view->outputHTML();
    }
}
