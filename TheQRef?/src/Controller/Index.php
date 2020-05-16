<?php

namespace Controller;

use View\IndexView;

class Index implements Controller {
    private string $errorMessage;

    public function display() {
        $this->errorMessage = "";

        // Provjera da li je korisnik ulogiran
        if(\Session\Session::get("login")) {
            redirect(\Routing\Route::get('home')->generate());
        }

        if(isset($_POST) && !empty($_POST)) {
            $this->loginCheck();
            unset($_POST);
        }

        $a = new IndexView("index");
        $a->addParam("login_route", \Routing\Route::get("empty")->generate());
        $a->addParam("register_route", \Routing\Route::get("register")->generate());
        $a->addParam("error_message", $this->errorMessage);
        $a->outputHTML();

    }

    /**
     * Metoda provjerava ispravnost unesenih podataka za login, a to
     * su korisnicko ime(e-mail) i lozinka.
     */
    private function loginCheck(): void {
        $this->errorMessage = "";

        if(!isset($_POST["username"]) || empty($_POST["username"])) {
            $this->errorMessage .= "Username is missing. ";
        }
        if(!isset($_POST["password"]) || empty($_POST["password"])) {
            $this->errorMessage .= "Password is missing. ";
        }
        if(!empty($this->errorMessage)) {
            return;
        }

        $user = new \Model\User();
        $obj = $user->exists('email', $_POST["username"]);
        $obj = !empty($obj) ? $obj[0] : [];
        $pw = sha1($_POST["password"]);
        if(empty($obj) || $obj->email !== $_POST["username"] || $obj->password !== $pw) {
            $this->errorMessage .= "Wrong username or password. ";
            return;
        }

        \Session\Session::set($obj->id, $obj->name, $obj->surname);
        redirect(\Routing\Route::get("home")->generate());
    }

}
