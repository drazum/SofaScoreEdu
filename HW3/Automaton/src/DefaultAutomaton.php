<?php



class DefaultAutomaton extends Automaton {
    private string $inputRegex;
    private array $mapRegex;
    private $extract;

    /**
     * DefaultAutomaton constructor.
     * Konstruktorska metoda.
     * @param $input ulazni regularni izraz. Posebni parametri
     * nalaze se unutar tagova <>, te se smiju iskljucivo sastojati
     * od brojeva , malih slova engleske abecede te znaka podvlake .
     * @param array $regex mapa imena parametara i prudruzenih
     * regularnih izraza ; regularni izrazi moraju biti valjani i u
     * skladu s PHP notacijom da bi ih PCRE mogao izvoditi .
     */
    public function __construct(string $input, array $regex = []) {
        $this->inputRegex = $input;
        $this->mapRegex = $regex;

        $this->extract = function ($match) use ($input, $regex) : string {
            foreach ($match as $m) {
                $par = trim($m, "<>");
                return $regex[$par];
            }
        };
    }


    /**
     * Nadjacana metoda.
     *
     * @param string $input ulazni niz znakova
     * @return bool za podudaranje podniza true, inace false
     */
    public function match (string $input) : bool {

        $result = preg_replace_callback("@<[a-z\d_]+>@", $this->extract, $this->inputRegex);

        if(preg_match("@^".$result."$@", $input)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Nadjacana metoda.
     *
     * @param array $array asocijativno polje s imenom parametra automata
     * i njegovom vrijednosti
     * @return string generirani niz
     */
    public function generate (array $array = []) : string {

        $fo = function ($match) use ($array) {
            foreach ($match as $m) {
                $par = trim($m, "<>");
                if(!array_key_exists($par, $array)) {
                    return "-Missing param ".$par."-";
                }
                if (!preg_match("@^".$this->mapRegex[$par]."@i", $array[$par])) {
                    return "-Value ".$par." not valid-";
                }
                return $array[$par];
            }
        };

        $result = preg_replace_callback("@<[a-z\d_]+>@", $fo, $this->inputRegex);

        return $result;
    }
}