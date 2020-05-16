<?php

namespace View;

class NavigationBarView extends View {

    public function __construct() {
        parent::__construct("navigationbar");

        $this->addParam("account_route", \Routing\Route::get("account")->generate());
        $this->addParam("name", \Session\Session::get("name"));
        $this->addParam("surname", \Session\Session::get("surname"));
        $this->addParam("home_route", \Routing\Route::get("home")->generate());
        $this->addParam("logout_route", \Routing\Route::get("logout")->generate());

        $this->addParam("create_quiz_route", \Routing\Route::get("create")->generate());
        $this->addParam("quiz_list_route", \Routing\Route::get("list")->generate());
        $this->addParam("statistics_route", \Routing\Route::get("statistics")->generate());
        $this->addParam("solve_route", \Routing\Route::get("play")->generate());
    }

}
