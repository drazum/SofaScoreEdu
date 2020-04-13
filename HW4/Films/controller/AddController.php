<?php

namespace controller;

class AddController extends AbstractController {

    private string $errorMessage;
    private $sort;

    public function __construct($data = null) {
        $this->sort = get("sort");
        if (!empty($data)) {
            $this->processData($data);
        }
    }

    /**
     * Metoda sortira polja unutar polja u kojoj su vrijednosti
     * integer-i u obliku string-a
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

            if($sort === "title") {
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
     * @param $data
     */
    public function processData($data) : void{
        $this->errorMessage = "";

        // Provjera postojanja imena filma iz forme
        if(!isset($data["name"]) || empty($data["name"])) {
            $this->errorMessage .= "Movie title is missing. ";
        }
        // Provjera postojanja vremena trajanja filma iz forme
        if(!isset($data["duration"]) || empty($data["duration"])) {
            $this->errorMessage .= "Duration is missing. ";
        }
        // Provjera postojanja ucitane datoteke iz forme
        if(!isset($_FILES["headlineImg"]) || empty($_FILES["headlineImg"]["size"])) {
            $this->errorMessage .= "Movie headline image is missing.";
        }

        if(!empty($this->errorMessage)) {
            return;
        }

        // Escape upisanog imena koje je korisnik unio
        $movieTitle = __($data["name"]);

        // Spremi sliku filma
        $modelFilm = new \model\Film();
        $coverPath = $modelFilm->saveHeadlineImage($_FILES, $id);

        // Neuspjesno spremanje slike jer je krivi format datoteke
        if($coverPath === null) {
            $this->errorMessage .= "Supported file extensions are jpg, jpeg, gif, png.";
            return;
        }

        // Dohvati ID zanra
        $modelGenre = new \model\Genre();
        $genreId = $modelGenre->getId($data["genre"]);

        // Formiraj asocijativno polje iz dobivenih vrijednosti
        $filmElements = [
            "id" => $id,
            "name" => $movieTitle,
            "id_genre" => $genreId,
            "year" => $data["year"],
            "duration" => $data["duration"],
            "cover" => $coverPath
        ];

        // Upisi film u datoteku
        $success = $modelFilm->insertMovie($filmElements);

        if(!$success) {
            $this->errorMessage .= "Movie already exists. ";
        }
    }

}
