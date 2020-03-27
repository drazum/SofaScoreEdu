<?php
declare(strict_types=1);

/**
* Uvijek ispisuje sadrzaj " <! doctype html > "
* i koristi se kao prva naredba
* kod stvaranja dokumenta .
*/
function create_doctype () : void{
    echo "<!doctype html>";
}

/**
* Ispisuje otvarajuci tag < html >
*/
function begin_html () : void{
    echo "<html>";
}

/**
* Ispisuje zatvarajuci tag </ html >
*/
function end_html (){
    echo "</html>";
}

/**
* Ispisuje otvarajuci tag < head >
*/
function begin_head (){
    echo "<head>";
}

/**
* Ispisuje zatvarajuci tag </ head >
*/
function end_head (){
    echo "</head>";
}

/**
* Ispisuje otvarajuci tag < body > te mu
* pridruzuje parove ( atribut , vrijednost ) na
* temelju polja predanih parametara .
* Parove ( atribut , vrijednost ) potrebno je umetnuti u
* tag na valjan nacin : nazivAtributa = " vrijednostAtributa " .
*
* @param { array } $params asocijativno polje
* parova atribut = > vrijednost
*/
function begin_body ( array $params = [] ) : void{
    $startTag = "<body";
    $contentsExist = false;

    $body = create_element("body", false, $params);

    //$body = concatenate_tag_and_attributes($params, $contentsExist, $startTag);
    echo $body;
}

/**
* Ispisuje zatvarajuci tag </ body >
*/
function end_body () : void{
    echo "</body>";
}

/**
 * Ispisuje otvarajuci tag < table >. Polje parametara
 * odredjuje atribute tablice i
 * vrijednosti atributa .
 *
 * @param { array } $params polje parametara spremljenih
 * po principu ' atribut ' = > ' vrijednost '
 */
function create_table ( array $params = [] ) : void{
    $startTag = "<table";
    $contentsExists = false;

    $table = create_element("table", false, $params);
    //$table = concatenate_tag_and_attributes($params,$contentsExists, $startTag);

    echo $table;
}

/**
 * Ispisuje zatvarajuci tag </ table >
 */
function end_table () : void{
    echo "</table>";
}

/**
 * Generira HTML potreban za stvaranje jednog retka tablice .
 * U polju parametara koje prima moraju biti definirane i
 * celije tablice i to parametrom ' contents '.
 * Polje ima sljedeci format :
 * array (
 * ' atribut1 ' = > ' vrijednost1 ' ,
 * ...
 * ' atributN ' = > ' vrijednostN ' ,
 * ' contents ' = > array ( ' cell1 ' , ' cell2 ' , ... , ' cellM ')
 * )
 * Parametar contents odredjuje 1 D polje i svaki element je
 * niz znakova . No , elementi nisu vrijednosti koje treba
 * ispisati u celijama , nego <b > HTML kod </ b > koji definira
 * svaku od celija , npr . ' <td > celija </ td > '.
 * Prazan redak generira se u slucaju da je
 * parametar contents postavljen na prazan niz znakova ili
 * da uopce nije poslan .
 *
 * @param { array } $params polje parametara koje odredjuje
 * jedan redak tablice
 * @return niz znakova koji predstavlja HTML kod retka tablice
 */
function create_table_row ( array $params = [] ) {
    $startTag = "<tr";
    $contentsExists = false;

    $tableRow = concatenate_tag_and_attributes($params, $contentsExists, $startTag);

    /* Ako kljuc 'contents' postoji, spremi element po element
         vrijednosti u string prije zatvaranja tag-a */
    if($contentsExists){
        foreach ($params['contents'] as $content) {
            // $content je oblika <td>celija</td>
            $tableRow .= $content;
        }
    }

    $tableRow .= "</tr>";

    $tableRow = create_element("tr", true, $params);

    return $tableRow;
}

/**
 * Na temelju predanih parametara koji odredjuju atribute i
 * vrijednosti generira HTML kod celije . Polje je oblika :
 * array ( ' atribut ' = > ' vrijednost1 ' ,
 * ' atribut2 ' = > ' vrijednost2 ' , ... ,
 * ' atributN ' = > ' vrijednostN ' ).
 * Sadrzaj celije odredjen je parametrom ' contents '.
 * Ako tog parametra nema ili je jednak praznom
 * nizu znakova , potrebno je generirati praznu celiju :
 * < td atribut1 = " vrijednost1 " ... atributN = " vrijednostN " > </ td >
 *
 * @param { array } $params polje parametara koje odredjuje celiju
 * @return niz znakova koji odredjuje HTML kod celije
 */
function create_table_cell ( array $params = [] ){
    $startTag = "<td";
    $contentsExists = false;

    $tableCell = concatenate_tag_and_attributes($params, $contentsExists, $startTag);

    /* Ako kljuc 'contents' postoji, spremi vrijednost u string
        prije zatvaranja tag-a */
    if($contentsExists){
        $tableCell .= $params['contents'];
    }

    $tableCell .= "</td>";
    $tableCell = create_element("td", true, $params);
    // Zavrsni oblik: <td  atribut1='vrijednost1' atribut2='vrijednost2'>DATA</td>
    return $tableCell;
}

/**
 * Na temelju predanih parametara koji odredjuju atribute ,
 * naziva elementa i zastavice koja odredjuje ima li
 * otvarajuci tag pripadajuci zatvarajuci tag generira
 * HTML kod proizvoljnog elementa . Polje parametara je oblika
 * array ( ' atribut ' = > ' vrijednost1 ' ,
 * ' atribut2 ' = > ' vrijednost2 ' , ... ,
 * ' atributN ' = > ' vrijednostN ' ).
 * Ako sadrzaj elementa treba biti prazan ili element
 * uopce nije definiran tako da treba imati sadrzja ,
 * potrebno je ili postaviti parametar ' contents ' na
 * prazan niz znakova ili ga uopce ne poslati .
 *
 * @param { String } $name naziv elementa
 * @param { boolean } true ako ima zatvarajuci tag , false inace
 * @param { array } $params polje parametara koje odredjuje celiju
 * @return niz znakova jednak HTML kodu elementa
 */
function create_element ( string $name , $closed = true , array $params = [] ){

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

?>
