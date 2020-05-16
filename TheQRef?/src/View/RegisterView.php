<?php

namespace View;

class RegisterView extends View {
    public function __construct(string $templateName) {
        parent::__construct($templateName);

        $this->addParam("register_route", \Routing\Route::get("register")->generate());
    }
}
