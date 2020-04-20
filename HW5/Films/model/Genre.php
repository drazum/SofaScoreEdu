<?php

namespace model;

class Genre extends AbstractModel {

    /**
     * Nadjacana metoda.
     * Vraca zanr u obliku niza znakova pod odredenim
     * identifikacijskim brojem u bazi podataka.
     *
     * @param string $id Identifikacijski broj
     * @return string Zanr
     */
    public function getById(string $id) : string {
        $db = \db\DBPool::getInstance();

        $sql = <<<SQL
            SELECT name FROM genre
            WHERE id=(:id)
        SQL;

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        $name = $stmt->fetch(\PDO::FETCH_COLUMN);

        return $name;
    }

    /**
     * Metoda vraca identifikacijski broj zanra
     * iz baze podataka prema njegovom imenu.
     *
     * @param string $name Ime zanra
     * @return string Identifikacijski broj
     */
    public function getId(string $name) : string{
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT id FROM genre
            WHERE name=(:name)
        SQL;
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':name' => $name
        ]);

        $id = $stmt->fetch(\PDO::FETCH_COLUMN);

        return $id;
    }

    /**
     * Nadjacana metoda.
     * Vraca polje svih zanrova iz baze podataka.
     *
     * @return array Polje zanrova
     */
    public function getAll() : array {
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT name FROM genre
        SQL;

        $stmt = $db->query($sql);

        $genres = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        return $genres;
    }

}
