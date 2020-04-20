<?php
declare(strict_types=1);

/**
* Uvijek ispisuje sadrzaj "<!doctype html>"
* i koristi se kao prva naredba
* kod stvaranja dokumenta.
*/
function create_doctype() : void{
    echo "<!doctype html>";
}

/**
* Ispisuje otvarajuci tag <html>
*/
function begin_html() : void{
    echo "<html>";
}

/**
* Ispisuje zatvarajuci tag </html>
*/
function end_html() {
    echo "</html>";
}

/**
* Ispisuje otvarajuci tag <head>
*/
function begin_head() {
    echo "<head>";
}

/**
* Ispisuje zatvarajuci tag </head>
*/
function end_head() {
    echo "</head>";
}

/**
* Ispisuje otvarajuci tag <body> te mu
* pridruzuje parove (atribut, vrijednost) na
* temelju polja predanih parametara.
* Parove (atribut, vrijednost) potrebno je umetnuti u
* tag na valjan nacin: nazivAtributa="vrijednostAtributa".
*
* @param array $params asocijativno polje
* parova atribut=>vrijednost
*/
function begin_body(array $params = []) : void{
    $tag = "body";
    $closingTag = false;

    $body = create_element($tag, $params, $closingTag);

    echo $body;
}

/**
* Ispisuje zatvarajuci tag </body>
*/
function end_body() : void{
    echo "</body>";
}

/**
 * Ispisuje otvarajuci tag <table>. Polje parametara
 * odredjuje atribute tablice i vrijednosti atributa.
 *
 * @param array $params polje parametara spremljenih
 * po principu 'atribut'=>'vrijednost'
 */
function create_table(array $params = []) : void{
    $tag = "table";
    $closingTag = false;

    $table = create_element($tag, $params, $closingTag);

    echo $table;
}

/**
 * Ispisuje zatvarajuci tag </table>
 */
function end_table() : void{
    echo "</table>";
}

/**
 * Generira HTML potreban za stvaranje jednog retka tablice.
 * U polju parametara koje prima moraju biti definirane i
 * celije tablice i to parametrom 'contents'.
 * Polje ima sljedeci format:
 * array(
 * 'atribut1'=>'vrijednost1',
 * ...
 * 'atributN'=>'vrijednostN',
 * 'contents'=>array('cell1', 'cell2', ... , 'cellM')
 * )
 * Parametar contents odredjuje 1 D polje i svaki element je
 * niz znakova. No, elementi nisu vrijednosti koje treba
 * ispisati u celijama, nego <b>HTML kod</b> koji definira
 * svaku od celija, npr. '<td>celija</td>'.
 * Prazan redak generira se u slucaju da je
 * parametar contents postavljen na prazan niz znakova ili
 * da uopce nije poslan.
 *
 * @param array $params polje parametara koje odredjuje
 * jedan redak tablice
 * @return string niz znakova koji predstavlja HTML kod retka tablice
 */
function create_table_row(array $params = []) : string{
    $tag = "tr";
    $closingTag = true;

    $tableRow = create_element($tag, $params, $closingTag);

    return $tableRow;
}

/**
 * Na temelju predanih parametara koji odredjuju atribute i
 * vrijednosti generira HTML kod celije. Polje je oblika:
 * array (
 * 'atribut'=>'vrijednost1',
 * 'atribut2'=>'vrijednost2', ... ,
 * 'atributN'=>'vrijednostN'
 * ).
 * Sadrzaj celije odredjen je parametrom 'contents'.
 * Ako tog parametra nema ili je jednak praznom
 * nizu znakova, potrebno je generirati praznu celiju:
 * <td atribut1="vrijednost1" ... atributN="vrijednostN"> </td>
 *
 * @param array $params polje parametara koje odredjuje celiju
 * @return string niz znakova koji odredjuje HTML kod celije
 */
function create_table_cell(array $params = []) : string{
    $tag = "td";
    $closingTag = true;

    $tableCell = create_element($tag, $params, $closingTag);

    // Zavrsni oblik: <td  atribut1='vrijednost1' atribut2='vrijednost2'>DATA</td>
    return $tableCell;
}

/**
 * Na temelju predanih parametara koji odredjuju atribute,
 * naziva elementa i zastavice koja odredjuje ima li
 * otvarajuci tag pripadajuci zatvarajuci tag generira
 * HTML kod proizvoljnog elementa. Polje parametara je oblika
 * array (
 * 'atribut'=>'vrijednost1',
 * 'atribut2'=>'vrijednost2', ... ,
 * 'atributN'=>'vrijednostN'
 * ).
 * Ako sadrzaj elementa treba biti prazan ili element
 * uopce nije definiran tako da treba imati sadrzaja,
 * potrebno je ili postaviti parametar 'contents' na
 * prazan niz znakova ili ga uopce ne poslati.
 *
 * @param string $name naziv elementa
 * @param bool true ako ima zatvarajuci tag , false inace
 * @param array $params polje parametara koje odredjuje celiju
 * @return string niz znakova jednak HTML kodu elementa
 */
function create_element(string $name, array $params = [], bool $closed = true) : string{

    $element = "<".$name;
    $CONTENTS = "contents";

    if(!empty($params)) {
        foreach ($params as $k => $v) {
            if ($k === $CONTENTS) {
                continue;
            }

            $element .= " " . $k . "=\"" . $v . "\"";
        }
    }
    $element .= ">";

    if(isset($params[$CONTENTS])) {
        $contents = $params[$CONTENTS];

        if (is_array($contents)) {
            foreach ($contents as $v) {
                $element .= $v;
            }
        } else {
            $element .= $params[$CONTENTS];
            //$element .= $contents;
        }
    }

    if ($closed) {
        $element .= "</" . $name . ">";
    }

    return $element . "\n";
}

/**
 * Generira tag <form> i dodjeljuje mu atribute action i
 * method s vrijednostima koje ovise o predanim parametrima
 *
 * @param string $action relativna ili apsolutna putanja
 * do skrtipte za obradu obrasca
 * @param string $method GET ili POST
 * @param stirng $enctype Kodiranje
 */
function start_form(string $action = NULL , string $method = NULL , string $enctype = NULL) : void{
    $tag = "form";
    $closingTag = false;
    $params = ["action" => $action, "method" => $method, "enctype" => $enctype];

    $form = create_element($tag, $params, $closingTag);

    echo $form;
}

/**
 * Ispisuje zatvarajuci tag </form>
 */
function end_form() : void{
    echo "</form>";
}

/**
 * Stvara polje za unos teksta pri cemu su atributi i njihove
 * vrijednosti odredjene predanim 2 D poljem parametara.
 * Struktura polja parametara:
 * array (
 * 'atribut'=>'vrijednost1',
 * 'atribut2'=>'vrijednost2',
 *  ... ,
 * 'atributN'=>'vrijednostN'
 * ).
 *
 * @param array $params asocijativno polje parova oblika
 * atribut=>vrijednost
 * @return string niz znakova koji predstavlja generirani input tag
 */
function create_input(array $params = []) : string{
    $tag = "input";
    $closingTag = false;

    $input = create_element($tag, $params, $closingTag);

    return $input;
}

/**
 * Generira padajuci izbornik odredjen elementom select.
 * Predani parametri odredjuju atribute izbornika (npr. name)
 * te opcije koje izbornik treba sadrzavati, a one se
 * predaju u preko kljuca 'contents'.
 * Polje ima sljedeci format :
 * array (
 * 'kljuc1'=>'vrijednost1',
 *  ... ,
 * 'kljucN'=>'vrijednostN',
 * 'contents'=>array ('option1', 'option2', ... , 'optionM')
 * )
 * Parametar contents odredjuje 1 D polje i da je svaki element
 * niz znakova. No, elementi nisu vrijednosti koje treba
 * ispisati kao opcije, nego <b>HTML kod</b> koji definira
 * svaku od opcija, npr. '<option>1</option>'
 *
 * @param array $params polje parametara koje odredjuje
 * padajuci izbornik
 * @return string niz znakova koji predstavlja generirani select tag
 */
function create_select(array $params = []) : string{
    $tag = "select";
    $closingTag = true;

    $select = create_element($tag, $params, $closingTag);

    return $select;
}

/**
 * Stvara element button pomocu predanih parametara i vraca
 * generirani niz tag. Sadrzaj gumba odredjuje parametar
 * contents. Ako je njegova vrijednost jednaka praznom
 * nizu znakova ili uopce nije poslan, sadrzaj treba
 * biti prazan.
 *
 * @param array $params polje parametara koje odredjuje dugme
 * @return string niz znakova koji predstavlja generirani tag button
 */
function create_button(array $params = []) : string{
    $tag = "button";
    $closingTag = true;

    $button = create_element($tag, $params, $closingTag);

    return $button;
}

?>
