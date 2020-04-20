<?php

namespace controller;

session_start();

class LogoutController extends AbstractController {

    protected function doJob(): void {
        session_destroy();
        redirect("./index.php");
    }
}