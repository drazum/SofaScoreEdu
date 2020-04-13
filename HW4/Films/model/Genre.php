<?php

namespace model;

class Genre extends AbstractModel {

    /**
     * Nadjacana metoda.
     * Vraca zanr u obliku niza pod odredenim
     * identifikacijskim brojem u datoteci.
     *
     * @param string $id Identifikacijski broj
     * @return string Zanr
     */
    public function getById(string $id) : string {
        $genre = new \db\DataAccess();
        $genre->selectGenreData($id);

    }

    /**
     * Metoda vraca identifikacijski broj zanra
     * iz datoteke prema njegovom imenu.
     *
     * @param string $name Ime zanra
     * @return string Identifikacijski broj
     */
    public function getId(string $name) : string{
        return \db\DataAccess::getGenreId($name);
    }

    /**
     * Nadjacana metoda.
     * Vraca polje svih zanrova iz datoteke.
     *
     * @return array Zanrovi
     */
    public function getAll() : array {
        $genre = new \db\DataAccess();
        return $genre->selectAllGenreData();
    }

}
