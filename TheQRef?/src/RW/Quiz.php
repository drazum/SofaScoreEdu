<?php

declare(strict_types=1);

namespace RW;

/**
 * Class Quiz
 * Razred koji zna raditi sa strukturuom podataka u direktoriju RW (ReadWrite).
 * Svrha mu je prikazivati i spremati pitanja za svaki pojedini kviz, za svakog korisnika.
 * Vise u readme.txt koji se nalazi u RW direktoriju.
 * @package RW
 */
class Quiz {
    private const STATISTICS_FILE = __DIR__."/statistics.qref";

    /**
     * Metoda kreira datoteku(za kviz) .qref i direktoij(za korisnika) ako ne postoje,
     * i sprema napisana pitanja u .qref datoteku.
     *
     * @param string $userID id korisnika
     * @param string $quizID id kviza
     * @param string $content podaci koji se spremaju u .qref datoteku
     */
    public function saveQuizContent(string $userID, string $quizID, string $content) {
        // Napravi direktorij za korisnika i datoteku za trenutni kviz (ako ne postoje)
        $dir = $this->createUserDir($userID);
        $file = $this->createQuizFile($dir, $quizID);
        file_put_contents($file, $content);
    }


    /**
     * Metoda dohvaca napisani tekst u datoteci kviza pojedinog korisnika.
     * Takoder, funkcija stvara ako ne postoji direktorij ili datoteka.
     *
     * @param string $userID id korisnika
     * @param string $quizID id kviza
     * @return string procitana datoteka
     */
    public function getQuizContent(string $userID, string $quizID): string {
        // Napravi direktorij za korisnika i datoteku za trenutni kviz (ako ne postoje)
        $dir = $this->createUserDir($userID);
        $file = $this->createQuizFile($dir, $quizID);
        return file_get_contents($file);
    }

    /**
     * Dohvati sve id-eve kvizova trenutno aktivnog korisnika.
     * Metoda radi na nacin da prema zadanom id-u korisnika nade
     * direktorij, te onda u direktoriju pomocu regexa izvuce iz imena
     * datoteke id kviza.
     * Opisi imenovanja u readme.txt
     *
     * @param string $userID id korisnika
     * @return array polje id-eva
     */
    public function getAllUserQuizIDs(string $userID): array {
        $path = __DIR__ . "/../RW/Quizzes/user_" . $userID;
        if(!file_exists($path)) {
            return [];
        }
        $files = array_slice(scandir($path), 2);
         foreach ($files as $index=>$file) {
             $files[$index] = preg_replace("@\w+_(\d+).\w+@", "$1", $file);
         }
         return $files;
    }

    /**
     * Metoda dohvaca sve id-eve kvizova korisnika koji nisu aktivni.
     * Radi na isti nacin kao iznad navedena getAllUserQuizIDs, ali
     * pohranjuje u polje sve id-eve osim iz direktorija trenutno aktivnog
     * korisika ciji id predajemo kao argument
     *
     * @param string $userID id aktivnog korisnika
     * @return array polje id-eva kvizova svih korisnika
     */
    public function getAllOtherQuizIDs(string $userID): array {
        $mainDirPath = __DIR__ . "/../RW/Quizzes/*";
        $activeUser = __DIR__ . "/../RW/Quizzes/user_" . $userID;
        $collection = [];
        $dirs = glob($mainDirPath);
        foreach ($dirs as $dir){
            if($dir === $activeUser){
                continue;
            }
            $files = array_slice(scandir($dir), 2);
            foreach ($files as $index=>$file) {
                $files[$index] = preg_replace("@\w+_(\d+).\w+@", "$1", $file);
            }
            $collection = array_merge($collection, $files);
//            array_push($collection, $files);
        }
        return $collection;
    }

    /**
     * Metoda kreira direktorij za korisnika pod nazivom user_id ako
     * vec ne postoji. Unutar tog direktorija su pohranjeni svi kvizovi
     *
     * @param string $userID
     * @return string
     */
    private function createUserDir(string $userID): string {
        $path = __DIR__ . "/../RW/Quizzes/user_" . $userID;
        // Nadi folder u Quizzes s ID-em korisnika
        if(!is_dir($path) && !file_exists($path)){
            mkdir($path);
        }
        return $path;
    }

    /**
     * Metoda kreira .qref datoteku koja inicijalno sadrzi u sebi upute
     * za kreiranje kviza. Ime datoteke je quiz_id.gref
     *
     * @param string $path putanja da direktorija za stvaranje
     * @param string $quizID id aktivnog korisnika
     * @return string kreiranu putanju do novostvorene datoteke
     */
    private function createQuizFile(string $path, string $quizID): string {
        $initFile = __DIR__ . "/../RW/init.qref";
        $file = $path . "/quiz_" . $quizID . ".qref";
        if(!file_exists($file)) {
            copy($initFile, $file);
        }
        return $file;
    }

    /**
     * Metoda vraca polje procitanih bodova za svaki kviz.
     * Citanje se obavlja iz datoteke statistics.qref
     *
     * @param string $quizID id kviza
     * @return array polje bodova
     */
    private function getPoints(string $quizID): array {
        $file = file_get_contents(self::STATISTICS_FILE);
        $regex = "@{(?P<id>[\d]+)}:(?P<points>[\d,]*)@";

        $points = [];

        $f = function ($match) use (&$points, $quizID) {
            if($match["id"] === $quizID) {
                $points = explode("," ,$match["points"]);
            }
            return;
        };
        preg_replace_callback($regex, $f, $file);

        $points = array_map('intval', $points);
        return $points;
    }

    /**
     * Metoda vraca maksimalni broj bodova za kviz pod
     * predanim id-em
     *
     * @param string $quizID id kviza
     * @return int najveci broj bodova
     */
    public function getMaxPoints(string $quizID): int {
        $points = $this->getPoints($quizID);
        return empty($points) ? 0 : max($points);
    }

    /**
     * Metoda vraca minimalni broj bodova za kviz pod
     * predanim id-em
     *
     * @param string $quizID id kviza
     * @return int najmanji broj bodova
     */
    public function getMinPoints(string $quizID): int {
        $points = $this->getPoints($quizID);
        return empty($points) ? 0 : min($points);
    }

    /**
     * Metoda vraca prosjek bodova za kviz pod
     * predanim id-em
     *
     * @param string $quizID id kviza
     * @return float prosjek bodova
     */
    public function getMeanPoints(string $quizID): float {
        $points = $this->getPoints($quizID);
        $res = floatval(array_sum($points)/count($points));
        return round($res, 2);
    }

    /**
     * Metoda vraca standardnu devijaciju bodova za
     * kviz pod predanim id-em
     *
     * @param string $quizID id kviza
     * @return float standardna devijacija
     */
    public function getStandardDeviationPoints(string $quizID): float {
        $points = $this->getPoints($quizID);
        $mean = $this->getMeanPoints($quizID);
        $numerator = array_map(function($element) use ($mean){
            return pow($element-$mean,2);
        }, $points);
        $res = sqrt(array_sum($numerator)/count($points));
        return round($res, 2);
    }

    /**
     * Metoda vraca medijan vrijednost bodova za
     * kviz pod predanim id-em
     *
     * @param string $quizID id kviza
     * @return float medijan
     */
    public function getMedianPoints(string $quizID): float {
        $points = $this->getPoints($quizID);
        $size = count($points);
        $div = intdiv($size, 2);
        if($size&1 === 1) {
            $res = $points[$div];
        }
        else {
            $res = floatval(($points[$div] + $points[$div-1])/count($points));
        }
        return round($res, 2);
    }

    /**
     * Za svaki novo stvoreni kviz ova metoda simulira nasumican
     * broj odigranih kvizova i nasumican broj bodova. Polje rezultata
     * sprema u datoteku statistics.qref, a sluzi statistickom prikazu
     *
     * NOTE: ovo je napravljeno jer nije implementirano rjesavanje kvizova
     *
     * @param string $quizID
     */
    public function simulatePoints(string $quizID): void {
        $file = file_get_contents(self::STATISTICS_FILE);

        $size = rand(1,15);
        $points = [];
        for($i=0;$i<$size;$i++) {
            array_push($points, rand(0,15));
        }
        $points = implode(",", $points);
        $file .= "\n" . "{" . $quizID . "}:" . $points;

        file_put_contents(self::STATISTICS_FILE, $file);
    }
}
