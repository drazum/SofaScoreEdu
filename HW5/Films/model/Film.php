<?php

namespace model;


class Film extends AbstractModel {

    /**
     * Metoda provjerava nalazi li se upisani film vec u bazi podataka.
     * Usporeduje naslov filma, godinu i zanr.
     *
     * @param array $filmElements asocijativno polje elemenata filma
     * @return bool TRUE ako film postoji, inace false
     */
    public function filmExists(array $filmElements) : bool{
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT * FROM film
            WHERE
            name=(:name) AND
            id_genre=(:id_genre) AND
            year=(:year)
        SQL;
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':name' => $filmElements["name"],
            ':id_genre' => $filmElements["id_genre"],
            ':year' => $filmElements["year"]
        ]);

        $movie = $stmt->fetch(\PDO::FETCH_ASSOC);

        return (empty($movie)) ? false : true;
    }

    /**
     * Nadjacana metoda.
     * Vraca polje u kojem je svaki element asocijativno
     * polje. Kljucevi su kolone relacije.
     * Polje sadrzi sve filmove iz baze podataka.
     *
     * @return array Polje asocijativnih polja svih filmova
     */
    public function getAll() : array {
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT * FROM film
        SQL;

        $stmt = $db->query($sql);

        $movies = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $movies;
    }

    /**
     * Nadjacana metoda.
     * Metoda vraca asocijativno polje gdje kljucevi predstavljaju
     * kolone relacije, a vrijednosti, vrijednosti u odredenom retku.
     *
     * @param string $id Identifikacijski broj
     * @return array Asocijativno polje vrijednosti specificnog filma
     */
    public function getById(string $id) : array {
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT * FROM film
            WHERE id=(:id)
        SQL;

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        $movie = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $movie;
    }

    /**
     * Metoda upisuje film u bazu podataka.
     *
     * @param array $filmElements Asocijativno polje s elementima filma
     * @return bool true ako je uspjesno upisan, false ako film vec postoji
     */
    public function insertMovie(array $filmElements) : bool{
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
        INSERT INTO film
        (name,id_genre,year,duration,cover,cover_format)
        VALUES
        (:name,:id_genre,:year,:duration,:cover,:cover_format)
        SQL;

        $stmt = $db->prepare($sql);

        $success = $stmt->execute([
            ':name' => $filmElements["name"],
            ':id_genre' => $filmElements["id_genre"],
            ':year' => $filmElements["year"],
            ':duration' => $filmElements["duration"],
            ':cover' => file_get_contents(addslashes($filmElements["cover"])),
            ':cover_format' => $filmElements["cover_format"],
        ]);

        return $success;
    }

    /**
     * Metoda brise film iz baze podataka.
     *
     * @param string $id Identifikacijski broj filma
     */
    public function deleteMovie(string $id) : void{
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            DELETE FROM film
            WHERE id=(:id)
        SQL;

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }
}

