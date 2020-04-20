<?php

namespace controller;

session_start();

class LoginController extends AbstractController {

    private string $errorMessage;

    public function __construct($data = null) {
        if (!empty($data)) {
            $this->processData($data);
        }
        $this->loginCheck();
    }

    /**
     * Metoda provjerava da li je korisnik ulogiran, ako je prosao
     * autentifikaciju dopusti mu ulaz
     */
    private function loginCheck() {
        if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            redirect("./index.php?action=add");
        }
    }

    /**
     * Nadjacana metoda.
     * Gradi stranicu s html elementima
     */
    protected function doJob(): void
    {
        $login = new \view\LoginView();
        $login->generateHTML();

        if(!empty($this->errorMessage)) {
            $error = new \view\ErrorView($this->errorMessage, false);
            $error->generateHTML();
        }
    }

    /**
     * Provjera unesenih podataka
     *
     * @param $data $_POST podaci
     */
    private function processData($data) : void{
        $this->errorMessage = "";

        // Provjera postojanosti i sadrzaja podataka za login
        if(!isset($data["username"]) || empty($data["username"])) {
            $this->errorMessage .= "Enter username. ";
        }
        if(!isset($data["password"]) || empty($data["password"])) {
            $this->errorMessage .= "Enter password. ";
        }
        if(!empty($this->errorMessage)) {
            return;
        }

        $userModel = new \model\User();
        $username = $data["username"];
        $password = $data["password"];

        if(!$userModel->userExists($username, $password)) {
            $this->errorMessage .= "Wrong username or password. ";
            return;
        }

        $_SESSION["loggedIn"] = true;
    }
}