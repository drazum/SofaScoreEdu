<?php
declare(strict_types=1);

/**
 * Razred sluzi oznacavanju razreda koji predstavljaju cvorove stabla.
 */
abstract class HTMLNode {
    /**
     * Vraca html cvor kao string.
     */
    public abstract function get_html();
}


class HTMLTextNode extends HTMLNode {

    /**
     * Sadrzaj tekstualnog cvora
     */
    private string $text;

    /**
     * Stvara novi tekstualni cvor zadanog sadrzaja
     * @param string $text tekst cvora
     */
    public function __construct(string $text) {
        $this->text = $text;
    }

    /**
     * Alias metode __toString u situacijama kada bi ova
     * metoda bila semanticki ispravnija
     *
     * @return string sadrzaj tekstualnog cvora
     */
    public function get_text() : string {
        return $this->text;
    }

    /**
     * @return string prikaz objekta u obliku sadrzaja
     * tekstualnog cvora
     */
    public function __toString() : string {
        return $this->text;
    }

    /**
     * @return string html cvor kao string
     */
    public function get_html() : string {
        return $this->get_text();
    }

}

abstract class HTMLElement extends HTMLNode {

    /**
     * Polje HTMLAttribute koji pripadaju elementu
     */
    protected array $attributes;

    /**
     * Djeca HTML elementa
     */
    protected HTMLCollection $children;

    /**
     * Zastavica koja oznacava ima li otvarajuci tag i pripadajuci
     * zatvarajuci tag.
     */
    protected bool $closed;

    /**
     * Naziv HTML elementa
     */
    protected string $name;

    /**
     * Stvara novi element zadanog naziva uz posvecivanje
     * paznje na otvarajuce i zatvarajuce tagove.
     *
     * @param string $name ime elementa
     * @param bool $closed zastavica postoji li zatvarajuci tag
     */
    public function __construct(string $name, $closed = true) {
        $this->closed = $closed;
        $this->name = $name;

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }

    /**
     * Elementu dodaje novo dijete.
     *
     * @param HTMLNode $node novo dijete
     * @return integer pozicija dodanog djeteta unutar
     * polje djece
     */
    public function add_child(HTMLNode $node) : int {
        return $this->children->add($node);
    }

    /**
     * Elementu dodaje cijelu kolekciju elemenata koji ce biti
     * njegova djeca.
     *
     * @param HTMLCollection $collection kolekcija elemenata
     * koja predstavlja djecu
     */
    public function add_children(HTMLCollection $collection) {
        foreach ($collection->get_all() as $node) {
            $this->children->add($node);
        }
    }

    /**
     * Vraca dijete koje se nalazi na zadanoj poziciji.
     *
     * @param int $position pozicija djeteta
     * @return HTMLNode dijete na zadanoj poziciji
     */
    public function get_child(int $position) : HTMLNode {
        return $this->children->get($position);
    }

    /**
     * Vraca trenutni broj djece elementa.
     *
     * @return integer broj djece elementa
     */
    public function get_children_number() : int {
        return $this->children->size();
    }

    /**
     * Uklanja dijete koje se nalazi na poziciji odredjenoj
     * parametrom $position.
     *
     * @param integer $position pozicija na kojoj se nalazi
     * dijete koje je potrebno ukloniti
     */
    public function remove_child(int $position) : void {
        $this->children->delete($position);
    }

    /**
     * Obavlja dodavanje novog atributa.
     *
     * @param HTMLAttribute $attribute novi atribut elementa
     */
    public function add_attribute(HTMLAttribute $attribute) : void {
        foreach ($this->attributes as $a) {
            if($a->get_name() == $attribute->get_name()) {
                $a->add_value($attribute->get_values());
                return;
            }
        }
        array_push($this->attributes, $attribute);
    }

    /**
     * Iz polja atributa uklanja atribut zadanog imena.
     *
     * @param string $attribute naziv atributa koji je
     * potrebno ukloniti
     */
    public function remove_attribute(string $attribute) : void {
        foreach ($this->attributes as $a) {
            if($a->get_name() == $attribute) {
                $a->remove_value($a->get_values());
            }
        }
    }

    /**
     * Vraca naziv elementa.
     *
     * @return string naziv elementa
     */
    public function get_name() : string {
        return $this->name;
    }

    /**
     * @return string objekt u obliku niza znakova
     * nazivTaga;nazivAtributa1="vrijednost" nazivAtributa2="vrijednost"
     */
    public function __toString() : string {
        $attributeStr = "";
        foreach ($this->attributes as $attribute) {
            $attributeStr .= $attribute . " ";
        }
        return $this->name . ";" . $attributeStr;
    }

    /**
     * @return string html oblik otvarajuceg taga s atributima
     */
    protected function get_head_tag() : string {
        $attributeString = "";
        foreach ($this->attributes as $a) {
            $aName = $a->get_name();
            $aValue = $a->get_values();
            $attributeString .= " " . $aName . "=" . $aValue;
        }
        return "<" . $this->name . $attributeString . ">";
    }

    /**
     * @return string html oblik zatvarajuceg taga
     */
    protected function get_tail_tag() : string {
        if($this->closed) {
            return "\n" . "</" . $this->name . ">";
        } else {
            return "";
        }
    }

    /**
     * @return string konkatenirani otvarajuci tag, podaci i
     * zatvarajuci tag u obliku html-a
     */
    public function get_html() {
        $headTad = $this->get_head_tag();
        $tailTag = $this->get_tail_tag();
        $content = $this->children->get_html_collection();

        return $headTad . $content . $tailTag;
    }

}


/**
 * Implementacija HTML atributa
 */
class HTMLAttribute {

    /**
     * Naziv atributa
     */
    private string $name;

    /**
     * Vrijednost atributa koja moze biti niz znakova ako se radi o
     * samo jednoj vrijednosti, odnosno polje ako se radi o vise
     * vrijednosti.
     *
     * @var mixed
     */
    private $value;

    /**
     * Kreira novi atribut prema zadanom imenu i vrijednosti
     *
     * @param string $name naziv atributa
     * @param mixed $value vrijednost (string) ili
     * vrijednosti (array) atributa
     */
    public function __construct(string $name , $value) {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Atributu dodaje jednu novu vrijednost. Nije dozvoljeno
     * duplicirati vrijednosti.
     *
     * @param string $value nova dodatna vrijednost namijenjena atributu
     */
    public function add_value(string $value) : void {
        if(!is_array($this->value)) {
            $this->value = explode(" ", $this->value);
        }
        array_push($this->value, trim($value, '"'));
    }

    /**
     * Atributu dodaje vise novih vrijednosti. Potrebno je paziti
     * da ne dodje do dupliciranja vrijednosti. Duplicirane vrijednosti
     * se preskacu.
     *
     * @param array $values polje novih vrijednosti
     */
    public function add_values(array $values) : void {
        if (is_array($this->value)) {
            $diffValues = array_diff($values, $this->value);
        } else {
            unset($values[$this->value]);
            $this->value = explode(" ", $this->value);
            $diffValues = $values;
        }

        if(!empty($diffValues)) {
            $this->value = array_merge($this->value, $diffValues);
        }
    }

    /**
     * Uklanja postojecu vrijednost atributa.
     *
     * @param string $value vrijednost koju je potrebno ukloniti
     * @return bool true-uspjesno uklonjeno, false-nema te vrijednosti
     */
    public function remove_value(string $value) : bool {
        if (is_array($this->value)) {
            if ($key = array_search($value, $this->value)) {
                unset($this->value[$key]);
                return true;
            }
            return false;
        } else {
            if ($this->value == trim($value, '"')) {
                $this->value = [];
                return true;
            }
            return false;
        }
    }

    /**
     * Vraca naziv atributa
     *
     * @return string naziv atributa
     */
    public function get_name() : string {
        return $this->name;
    }

    /**
     * Vraca vrijednosti atributa u formatu pogodnom za zapis u tagu.
     * Ex : key = "value"
     * Vraca se "value"
     *
     * @return string popis vrijednosti u obliku niza znakova
     */
    public function get_values() : string {
        $valueStr = "";
        if(!is_array($this->value)){
            $valueStr = $this->value;
            return '"'.$valueStr.'"';
        }
        foreach ($this->value as $v) {
            $valueStr .= $v . " ";
        }
        return '"'.$valueStr.'"';
    }

    /**
     * Zapisa atributa i njegove (njegovih) vrijednosti pomocu
     * niza znakova.
     *
     * @return string objekt u obliku niza znakova
     */
    public function __toString() : string {
        $name = $this->get_name();
        $values = $this->get_values();
        return $name . "=" . $values;
    }

}


class HTMLCollection {

    /**
     * Polje HTMLNode-ova koji su dio kolekcije
     */
    private array $nodes;

    /**
     * Stvara novu kolekciju i puni je cvorovima ako je barem jedan,
     * predan metodi. Pozicija svakog umetnutog cvora odgovara
     * poziciji cvora u predanom polju .
     *
     * @param array $nodes polje cvorova koje je potrebno
     * ubaciti u kolekciju
     */
    public function __construct($nodes = array()) {
        $this->nodes = array();
        if(count($nodes) !== 0) {
            $this->nodes = $nodes;
        }
    }

    /**
     * Umece novi cvor u kolekciju cvorova. Cvor se umece na
     * kraj polja, tako da njegovo mjesto uvijek odgovara
     * do tada umetnutom broju cvorova.
     *
     * @param HTMLNode $node cvor koji je potrebno umetnuti
     * @return integer mjesto unutar kolekcije na koje je cvor
     * umetnut
     */
    public function add(HTMLNode $node) : int {
        array_push($this->nodes, $node);
        $index = array_key_last($this->nodes);
        return $index;
    }

    /**
     * Dohvaca cvor kolekcije s tocno odredjene pozicije.
     *
     * @param integer $position pozicija cvora koji je potrebno
     * dohvatiti
     * @return HTMLNode cvor s trazene pozicije, ili null ako
     * cvor na toj poziciji ne postoji
     */
    public function get(int $position) : ?HTMLNode {
        if(array_key_exists($position, $this->nodes)) {
            return $this->nodes[$position];
        }
        return null;
    }

    /**
     * Vraca sve elemente kolekcije.
     *
     * @return array elementi kolekcije
     */
    public function get_all() : array {
        return $this->nodes;
    }

    /**
     * Vraca informaciju o velicini kolekcije.
     *
     * @return integer broj elemenata kolekcije
     */
    public function size() : int {
        return count($this->nodes);
    }

    /**
     * Brise element s tocno odredene pozicije iz kolekcije.
     *
     * @param integer $position pozicija elementa u kolekciji
     */
    public function delete(int $position) : void {
        unset($this->nodes[$position]);
    }

    /**
     * @return string html kolekcija u obliku niza znakova
     */
    public function get_html_collection() {
        $str = "";
        if(!empty($this->nodes)) {
            foreach ($this->nodes as $node){
                $str .= "\n".$node->get_html();
            }
        }
        return $str;
    }
}

class HTMLTitleElement extends HTMLElement {
    public function __construct(string $title = "") {
        $this->closed = true;
        $this->name = "title";

        $this->attributes = array();
        $this->children = new HTMLCollection([new HTMLTextNode($title)]);
    }
}

class HTMLTableElement extends HTMLElement
{
    public function __construct() {
        $this->closed = true;
        $this->name = "table";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLSelectElement extends HTMLElement
{
    public function __construct() {
        $this->closed = true;
        $this->name = "select";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLRowElement extends HTMLElement
{
    public function __construct() {
        $this->closed = true;
        $this->name = "tr";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLPElement extends HTMLElement {
    public function __construct() {
        $this->closed = true;
        $this->name = "p";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLOptionElement extends HTMLElement
{
    public function __construct() {
        $this->closed = true;
        $this->name = "option";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLMetaElement extends HTMLElement {
    public function __construct() {
        $this->closed = false;
        $this->name = "meta";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLInputElement extends HTMLElement
{
    public function __construct() {
        $this->closed = false;
        $this->name = "input";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLHtmlElement extends HTMLElement
{
    public function __construct () {
        $this->closed = true;
        $this->name = "html";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLHeadElement extends HTMLElement
{
    public function __construct() {
        $this->closed = true;
        $this->name = "head";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLFormElement extends HTMLElement
{
    public function __construct() {
        $this->closed = true;
        $this->name = "form";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLDivElement extends HTMLElement {
    public function __construct($name = "div", $closed = true) {
        $this->closed = $closed;
        $this->name = $name;

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLCellElement extends HTMLElement
{
    public function __construct(string $type = "td") {
        $this->closed = true;
        $this->name = $type;

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLButtonElement extends HTMLElement
{
    public function __construct() {
        $this->closed = true;
        $this->name = "button";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLBodyElement extends HTMLElement {
    public function __construct() {
        $this->closed = true;
        $this->name = "body";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}

class HTMLAElement extends HTMLElement
{
    public function __construct() {
        $this->closed = true;
        $this->name = "a";

        $this->attributes = array();
        $this->children = new HTMLCollection;
    }
}
