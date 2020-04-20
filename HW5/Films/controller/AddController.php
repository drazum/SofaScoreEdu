<?php

namespace controller;

session_start();

class AddController extends AbstractController {
    private static array $extensions = ["png", "jpg", "gif", "jpeg"];
    private string $errorMessage;
    private $sort;

    public function __construct($data = null) {
        $this->loginCheck();

        $this->sort = get("sort");

        if (!empty($data)) {
            $this->processData($data);
        }
    }

    /**
     * Metoda provjerava da li je korisnik ulogiran, radi blokirajuce
     * na nacin da ne dopusta dolazak na stranicu za dodavanje filmova
     * bez administratorskih prava
     */
    private function loginCheck() {
        if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
            redirect("./index.php?action=login");
        }
    }

    /**
     * Metoda sortira polja unutar polja u kojoj su vrijednosti
     * integer-i u obliku string-a
     *
     * @param $collection referenca na kolekciju filmova
     */
    private function sortNumeric(&$collection) : void{
        $s = function($first, $second) {
            $first = (int)$first[$this->sort];
            $second = (int)$second[$this->sort];
            return $first>$second;
        };

        usort($collection, $s);
    }

    /**
     * Metoda sortira polja unutar polja u kojoj su vrijednosti
     * string-ovi slova
     *
     * @param $collection referenca na kolekciju filmova
     */
    private function sortString(&$collection) : void{
        $s = function ($first, $second) {
            $first = strtolower($first[$this->sort]);
            $second = strtolower($second[$this->sort]);
            return strcmp($first, $second);
        };

        usort($collection, $s);
    }

    /**
     * Nadjacana metoda.
     * Gradi stranicu s html elementima
     */
    protected function doJob() : void{

        // Logout gumb
        $logoutHeader = new \view\LogoutHeaderView();
        $logoutHeader->generateHTML();

        // Header
        $header = new \view\HeaderView("Add Movie", true);
        $header->generateHTML();

        // Forma s elementima za upis
        $form = new \view\FormView();
        $form->generateHTML();

        // Nastavi dalje jedino ako nema poruka greske
        if(!empty($this->errorMessage)) {
            $error = new \view\ErrorView($this->errorMessage, false);
            $error->generateHTML();
        }

        // Dohvat svih filmova iz datoteke
        $modelFilm = new \model\Film();
        $collection = $modelFilm->getAll();

        // Ako je prisutan parametar sortiranja sortiraj kolekciju
        if(!empty($this->sort)) {
            $sort = $this->sort;

            if($sort === "name") {
                $this->sortString($collection);
            } else {
                $this->sortNumeric($collection);
            }
        }

        // Tablicni prikaz kolekcije
        $filmTable = new \view\FilmTableView($collection);
        $filmTable->generateHTML();
    }

    /**
     * Metoda manipulira primljenim podacima $_POST i $_FILES
     *
     * @param $data
     */
    public function processData($data) : void{
        $this->errorMessage = "";

        // Provjerava postojanja imena filma iz forme
        if(!isset($data["name"]) || empty($data["name"])) {
            $this->errorMessage .= "Movie title is missing. ";
        }
        // Provjerava postojanja vremena trajanja filma iz forme
        if(!isset($data["duration"]) || empty($data["duration"])) {
            $this->errorMessage .= "Duration is missing. ";
        }
        // Provjerava postojanja ucitane datoteke iz forme
        if(!isset($_FILES["headlineImg"]) || empty($_FILES["headlineImg"]["size"])) {
            $this->errorMessage .= "Movie headline image is missing.";
        }

        if(!empty($this->errorMessage)) {
            return;
        }

        // Escape upisanog imena koje je korisnik unio
        $movieTitle = __($data["name"]);

        // Naslovna slika filma
        $modelFilm = new \model\Film();
        $fileName = $_FILES["headlineImg"]["name"];
        $fileTmpName = $_FILES["headlineImg"]["tmp_name"];
        $fileExtension = strtolower(explode(".", $fileName)[1]);

        // Krivi format datoteke
        if(!in_array($fileExtension, self::$extensions)) {
            $this->errorMessage .= "Supported file extensions are jpg, jpeg, gif, png.";
            return;
        }


        // Dohvati ID zanra
        $modelGenre = new \model\Genre();
        $genreId = $modelGenre->getId($data["genre"]);

        // Formiraj asocijativno polje iz dobivenih vrijednosti
        $filmElements = [
            "name" => $movieTitle,
            "id_genre" => $genreId,
            "year" => $data["year"],
            "duration" => $data["duration"],
            "cover" => $fileTmpName,
            "cover_format" => $fileExtension
        ];

        // Postoji li film vec u bazi
        if($modelFilm->filmExists($filmElements)){
            $this->errorMessage .= "Movie already exists. ";
            return;
        }

        // Upisi film u bazu
        $success = $modelFilm->insertMovie($filmElements);
        if(!$success){
            $this->errorMessage .= "Something went wrong, please try again. ";
            return;
        }
    }

}
