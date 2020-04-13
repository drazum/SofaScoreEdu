<?php

namespace model;

class Film extends AbstractModel {
    private const KEYS = ["id", "name", "id_genre", "year", "duration", "cover"];

    /**
     * Nadjacana metoda.
     * Vraca polje u kojem je svaki element asocijativno
     * polje s kljucevima {const KEYS} i vrijednostima iz datoteke.
     * Polje sadrzi sve filmove iz datoteke.
     *
     * @return array Polje asocijativnih polja svih filmova
     */
    public function getAll() : array {
        $film = new \db\DataAccess();
        $allFilmData = $film->selectAllFilmData();

        $filmData = [];
        // Ekstrahiraj svaku vrijednost iz niza znakova u njoj pripadajuci kljuc
        foreach($allFilmData as $i => $filmLine) {
            $filmArray = explode(",", $filmLine);

            foreach ($filmArray as $j => $attribute) {
                unset($filmArray[$j]);
                $filmArray[self::KEYS[$j]] = trim($attribute, "\"");
            }

            $filmData[$i] = $filmArray;
        }
        return $filmData;
    }

    /**
     * Nadjacana metoda.
     * Metoda vraca asocijativno polje s kljucevima {const KEYS} i
     * vrijednostima iz datoteke za film pod odredenim identifikacijskim brojem.
     *
     * @param string $id Identifikacijski broj
     * @return array Asocijativno polje vrijednosti specificnog filma
     */
    public function getById(string $id) : array {
        $film = new \db\DataAccess();
        $filmLine = $film->selectFilmData($id);
        $filmArray = explode(",", $filmLine);

        foreach($filmArray as $i => $attribute) {
            unset($filmArray[$i]);
            $filmArray[self::KEYS[$i]] = trim($attribute, "\"");
        }

        return $filmArray;
    }

    /**
     * Metoda upisuje film u datoteku.
     *
     * @param array $filmElements Asocijativno polje s kljucevima
     * {const KEYS} i vrijednostima koje se trebaju upisati u datoteku
     * @return bool true ako je uspjesno upisan, false ako film vec postoji
     */
    public function insertMovie(array $filmElements) : bool{
        $film = new \db\DataAccess();
        $success = $film->insertData($filmElements);
        return $success;
    }

    /**
     * Metoda sprema sliku bazu.
     *
     * @param array $file
     * @param $id referenca na varijablu u koju ce se upisati
     * identifikacijski broj koji se genererira kod spremanja slike.
     * @return string|null Putanja do spremljene datoteke, null ukoliko
     * spremanje nije bilo uspjesno
     */
    public function saveHeadlineImage(array $file, &$id) : ?string{
        $film = new \db\DataAccess();
        $filePath = $film->saveImage($file,$id);
        return $filePath;
    }

    /**
     * Metoda brise film. Brise sliku iz baze i zapis u datoteci.
     *
     * @param string $id Identifikacijski broj filma
     */
    public function deleteMovie(string $id) : void{
        $film = new \db\DataAccess();
        $movie = $this->getById($id);
        $film->deleteData($id, $movie["cover"]);
    }
}

