<?php
declare(strict_types=1);

namespace db;

class DataAccess {
    private const FILM_FILE = "./db/film.txt";
    private const GENRE_FILE = "./db/genre.txt";
    private static $filmId = 1;


    /**
     * Metoda generira identifikacijski broj za novi film.
     * Cita sve ID-eve iz datoteke, sortira ih uzlazno i
     * uzima iduci slobodan broj
     * @return int Identifikacijski broj
     */
    public static function generateFilmId() : int {
        $filmFile = file_get_contents(self::FILM_FILE);
        $filmArray = explode("\n", $filmFile);

        $ids = [];
        // Pohrani u polje ID svakog filma
        foreach ($filmArray as $film) {
            if(empty($film)) {
                continue;
            }
            preg_match("@^\"([[:digit:]]*)\".*@", $film, $match);
            array_push($ids, (int)$match[1]);
        }
        // Sortiraj sve ID-eve i nadi najveci
        sort($ids);
        return end($ids)+1;
    }


    /**
     * Metoda vraca identifikacijski broj zanra prema njegovom imenu.
     *
     * @param string $genreName Ime zanra
     * @return string Identifikacijski broj
     */
    public static function getGenreId(string $genreName) : string {
        $genreFile = file_get_contents(self::GENRE_FILE);
        preg_match("@\"([[:digit:]]*)\",\"$genreName\"@", $genreFile,$match);
        [$line, $genreId] = $match;
        return $genreId;
    }


    /**
     * Metoda provjerava nalazi li se upisani film vec u bazi.
     *
     * @param string $name Ime filma
     * @param string $genreId Identifikacijski broj zanra
     * @param string $year Godina filma
     * @return bool True ako film vec postoji, inace false
     */
    static private function filmExists(string $name, string $genreId, string $year) : bool {
        $filmFile = file_get_contents(self::FILM_FILE);
        $filmArray = explode("\n", $filmFile);

        foreach ($filmArray as $film) {
            if(preg_match("@^\"\d+\",\"$name\",\"$genreId\",\"$year\".*@i", $film)) {
                return true;
            }
        }
        return false;
    }


    /**
     * Metoda upisuje film u datoteku.
     *
     * @param array $data Asocijativno polje koje sadrzi elemente filma. Kljucevi su
     * ["id", "name", "id_genre", "year", "duration", "cover"]
     * @return bool False ako film vec postoji, inace true
     */
    public function insertData(array $data) : bool {

        // Provjera postoji li film s istim imeno, zanrom i godinom vec u bazi
        if(self::filmExists($data["name"], $data["id_genre"], $data["year"])) {
            return false;
        }

        // Dodaj na svaki elemetn dvostruke navodnike i spoji sve u niz znakova
        $filmInfo = preg_replace("@^(.*)$@", "\"$1\"", $data);
        $filmInfo = implode(",", $filmInfo);

        file_put_contents(self::FILM_FILE, $filmInfo . "\n", FILE_APPEND);
        return true;
    }


    /**
     * Metoda brise zapis filma iz datoteke i njegovu sliku iz baze
     * @param string $filmId Identifikacijski broj filma u datoteci
     * @param string $coverPath Putanja do slike na posluzitelju
     */
    public function deleteData(string $filmId, string $coverPath) : void {
        $filmFile = file_get_contents(self::FILM_FILE);
        $filmArray = explode("\n", $filmFile);

        // Pronadi film s primljenim id-em i ukloni ga iz polja
        foreach ($filmArray as $index => $film) {
            if(preg_match("@^\"$filmId\".*@", $film)) {
                    unset($filmArray[$index]);
                    break;
            }
        }
        $filmFile = implode("\n", $filmArray);
        file_put_contents(self::FILM_FILE, $filmFile);

        unlink($coverPath);
    }


    /**
     * Metoda vraca niz znakova u kojem su detalji filma s
     * zadanim identifikacijskim brojem.
     *
     * @param int $filmId Identifikacijski broj filma
     * @return string|null Vraca string koji predstavlja liniju
     * datoteke u kojoj se nalazi $filmId, null ako filma nema
     */
    public function selectFilmData(string $filmId) : ?string {
        $filmFile = file_get_contents(self::FILM_FILE);
        $filmArray = explode("\n", $filmFile);

        foreach ($filmArray as $index => $film) {
            if(preg_match("@^\"$filmId\".*@", $film)) {
                return $film;
            }
        }
        return null;
    }


    /**
     * Metoda vraca polje stringova. Svaki string(niz znakova)
     * je jedna linija u datoteci i sadrzi detalje o filmu
     *
     * @return array Vraca polje stringova. Svaki element
     * polja je jedna linija datoteke
     */
    public function selectAllFilmData() : array {
        $filmFile = file_get_contents(self::FILM_FILE);
        $filmArray = explode("\n", $filmFile);

        return array_filter($filmArray, "strlen");
    }


    /**
     * Metoda vraca ime zanra pod zadanim identifikacijskim brojem
     *
     * @param string $genreId Identifikacijski broj
     * @return string Vraca string koji predstavlja zanr
     */
    public function selectGenreData(string $genreId) : string {
        $genreFile = file_get_contents(self::GENRE_FILE);

        preg_match("@\"$genreId\",\"([[:alpha:]]+)\"@", $genreFile, $match);
        [$line, $genre] = $match;
        return $genre;
    }


    /**
     * Metoda vraca polje stringova, od kojih je svaki element jedan zanr.
     *
     * @return array Vraca polje sa svim zanrovima
     */
    public function selectAllGenreData() : array {
        $genreFile = file_get_contents(self::GENRE_FILE);

        preg_match_all("@\"[[:digit:]]+\",\"([[:alpha:]]+)\"@", $genreFile, $match);
        [$lines, $genres] = $match;
        return $genres;
    }


    /**
     * Metoda sprema ucitanu sliku na posluzitelj i dodjeljuje unikatni
     * identifikacijski broj slici, koji je ujedno i identifikacijski broj
     * za zapis filma u datoteci.
     *
     * @param array $file Superglobalna varijabla $_FILES
     * @param $uniqueFileId referenca na varijablu u koju ce se pohraniti
     * identifikacijski broj
     * @return string|null Vraca niz znakova koji predstavljaju putanju do
     * spremljene slike na posluzitelju, null u slucaju krive ekstenzije ili
     * neuspjesnosti spremanja.
     */
    public function saveImage(array $file, &$uniqueFileId) : ?string {
        $extensions = ["png", "jpg", "gif", "jpeg"];
        if(isset($file["headlineImg"])) {
            $fileName = $file["headlineImg"]["name"];
            $fileExtension = strtolower(explode(".", $fileName)[1]);

            if(!in_array($fileExtension, $extensions)) {
                return null;
            }

            $uniqueFileId = (string)self::generateFilmId();

            $uploadDir = "./db/images/";
            $newFileName = $uploadDir . $uniqueFileId . "." . $fileExtension;

            if(move_uploaded_file($file["headlineImg"]["tmp_name"], $newFileName)) {
                return $newFileName;
            }
        }
        return null;
    }

}
