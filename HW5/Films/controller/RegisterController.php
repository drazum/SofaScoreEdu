<?php

namespace controller;

session_start();

class RegisterController extends AbstractController {

    private string $errorMessage;

    public function __construct($data = null) {
        if (!empty($data)) {
            $this->processData($data);
        }
        $this->loginCheck();
    }

    /**
     * Metoda provjerava da li je korisnik ulogiran, ako je prosao
     * autentifikaciju dopusti mu ulaz.
     * U ovom slucaju nakon registracije.
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
        $login = new \view\RegisterView();
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

        // Provjera postojanosti i sadrzaja podataka za registraciju
        if(!isset($data["firstName"]) || empty($data["firstName"])) {
            $this->errorMessage .= "Enter your first name. ";
        }
        if(!isset($data["lastName"]) || empty($data["lastName"])) {
            $this->errorMessage .= "Enter your last name. ";
        }
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
        $firstName = $data["firstName"];
        $lastName = $data["lastName"];
        $username = $data["username"];
        $password = $data["password"];

        if($userModel->usernameExist($username)) {
            $this->errorMessage .= "Username already taken. ";
            return;
        }

        // Upisi korisnika u bazu podataka
        $success = $userModel->insertUser($firstName, $lastName, $username, $password);

        if(!$success) {
            $this->errorMessage .= "Something went wrong. Please try again. ";
        }

        $_SESSION["loggedIn"] = true;

    }
}