<?php

namespace controller;

class IndexController extends AbstractController {

    private $letter;

    public function __construct($letter = null) {
        $this->letter = $letter;
    }

    /**
     * Nadjacana metoda
     * Gradi html elemente pocetne stranice.
     */
    protected function doJob() : void{
        // Header
        $header = new \view\HeaderView("Movies Collection", false);
        $header->generateHTML();

        // Letters
        $letters = range('A', 'Z');
        $alphabet = new \view\AlphabetView($letters);
        $alphabet->generateHTML();

        // Slovo nije uneseno
        if($this->letter === null) {
            return;
        }

        // Provjeri da li je slovo u engleskoj abecedi
        if(!in_array(strtoupper($this->letter), $letters)) {
            $error = new \view\ErrorView("Error: The letter you typed in URL does not exist in English alphabet.", false);
            $error->generateHTML();
            return;
        }

        // Dohvati sve filmove
        $modelFilm = new \model\Film();
        $films = $modelFilm->getAll();

        // Filtriraj sadrzaj prema unesenom slovu
        $collection = [];
        foreach($films as $film) {
            if(preg_match("@^$this->letter@", $film["name"])) {
                array_push($collection, $film);
            }
        }

        // Ne postoji film pod unesenim pocetnim slovom
        if(empty($collection)) {
            $errorMsg = "No movies with letter " . strtoupper($this->letter) . ".";
            $error = new \view\ErrorView($errorMsg, true);
            $error->generateHTML();
        }

        // Prikaz filmova pod unesenim slovom
        $filmTitleView = new \view\FilmTitleView($collection);
        $filmTitleView->generateHTML();
    }

}
