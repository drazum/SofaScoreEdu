<?php


namespace model;


class User extends AbstractModel {

    /**
     * Nadjacana metoda.
     * Vraca redak relacije korisnika koji se nalazi pod
     * unesenim identifikacijskim brojem.
     *
     * @param string $id Identifikacijski broj
     * @return array Asocijativno polje podataka korisika
     */
    public function getById(string $id) : array{
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT * FROM user
            WHERE
            id=(:id)
        SQL;
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
        ]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * Nadjacana metoda.
     * Vraca cijelu relaciju iz baze podataka u obliku
     * asocijativnog polja.
     *
     * @return array Asocijativno polje svih korisnika
     * i njihovih podataka
     */
    public function getAll(): array {
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT * FROM user
        SQL;

        $stmt = $db->query($sql);

        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $users;
    }

    /**
     * Metoda provjerava postoji li korisnik koji se
     * ulogirava u bazi podataka, i poklapaju li se
     * korisnicko ime i lozinka
     *
     * @param string $username Korisnicko ime
     * @param string $password Lozinka
     * @return bool True uspjesno ulogiran, false neuspjesno
     */
    public function userExists(string $username, string $password) : bool {
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT * FROM user
            WHERE
            username=(:username) AND 
            password=(:password)
        SQL;
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => sha1($password)
        ]);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (empty($user)) ? false : true;
    }

    /**
     * Metoda provjerava zauzetost korisickog imena
     *
     * @param string $username Korisnicko ime
     * @return bool True ako je zauzeto, inace false
     */
    public function usernameExist(string $username) : bool{
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
            SELECT * FROM user
            WHERE
            username=(:username)
        SQL;
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':username' => $username
        ]);

        $username = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (empty($username)) ? false : true;
    }

    /**
     * Metoda upisuje korisnika u bazu podataka
     *
     * @param string $firstName Ime
     * @param string $lastName Prezime
     * @param string $username Korisnicko ime
     * @param string $password Lozinka
     * @return bool True ako je uspjesno korisnik upisan, false inace
     */
    public function insertUser(string $firstName, string $lastName, string $username, string $password) : bool{
        $db = \db\DBPool::getInstance();
        $sql = <<<SQL
        INSERT INTO user
        (firstName,lastName,username,password)
        VALUES
        (:firstName,:lastName,:username,:password)
        SQL;

        $stmt = $db->prepare($sql);

        $success = $stmt->execute([
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':username' => $username,
            ':password' => sha1($password)
        ]);

        return $success;
    }

}