<?php

namespace Controller;

use View\HomeView;
use View\RegisterView;

class Register implements Controller {
    private string $errorMessage;

    public function display() {
        $this->errorMessage = "";

        if(isset($_POST) && !empty($_POST)) {
            $this->registerCheck();
            unset($_POST);
        }
        $a = new RegisterView("register");
        $a->addParam("error_message", $this->errorMessage);
        $a->outputHTML();
    }


    /**
     * Metoda provjerava ispravnost unesenih podataka za registraciju korisnika
     * i puni poruku greske.
     * Ako je sve u redu, spremi korisnika u bazu, spremi potrebne stvari u session
     * i preusmjeri na drugu rutu.
     */
    public function registerCheck(): void {
        $inputs = ["Name", "Surname", "Date of birth", "Email", "Password"];
        $user = new \Model\User();

        foreach ($user->getColumns() as $index=>$attribute) {
            if(!isset($_POST[$attribute]) || empty($_POST[$attribute])) {
                $this->errorMessage .= $inputs[$index] . " is missing. ";
            }
        }
        if(strlen($_POST["password"]) < 5) {
            $this->errorMessage .= "Password must contain at least 5 characters. ";
            return;
        }
        if ($_POST["password"] !== $_POST["passwordRepeat"]) {
            $this->errorMessage .= "Passwords do not match. ";
        }

        if(!empty($this->errorMessage)) {
            return;
        }

        if($user->loadAllByParam("WHERE email = ?", [post("email")])) {
            $this->errorMessage .= "E-mail already exists. ";
            return;
        }

        foreach ($user->getColumns() as $attribute) {
            if ($attribute === "password") {
                $user->$attribute = sha1(post($attribute));
                continue;
            }
            $user->$attribute = post($attribute);
        }

        $user->save();

        \Session\Session::set($user->getPrimaryKey(), __(post("name")), __(post("surname")));
        redirect(\Routing\Route::get("home")->generate());
    }
}
