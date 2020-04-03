<?php

declare(strict_types=1);

require_once "htmlLibrary.php";


$html = new HTMLHtmlElement();
$head = new HTMLHeadElement();
$body = new HTMLBodyElement();

$title = new HTMLTitleElement("2. zadatak");

/* DODAVANJE I BRISANJE ATRIBUTA */
$body->add_attribute(new HTMLAttribute("bgcolor", "red"));
$body->remove_attribute("bgcolor");
$body->add_attribute(new HTMLAttribute("bgcolor", "DarkSlateGrey"));

$meta = new HTMLMetaElement();
$meta->add_attribute(new HTMLAttribute("charset", "UTF-8"));
$head->add_child($title);
$head->add_child($meta);

/* Ispis zadanog teksta */
$div = new HTMLDivElement();
$p = new HTMLPElement();
$tekst = new HTMLTextNode("Generirani SofaScore primjer.");
$p->add_attribute(new HTMLAttribute("style", "font-size:30;color:white"));
$p->add_child($tekst);
$div->add_child($p);
$div->add_attribute(new HTMLAttribute("align", "center"));
$body->add_child($div);

/* Paragraf iznad tablice */
$tableName = new HTMLTextNode("Primjer tablice");
$p = new HTMLPElement();
$p->add_attribute(new HTMLAttribute("style", "font-size:20;color:lightblue"));
$p->add_child($tableName);
$body->add_child($p);

/* TABLICA */
$table = new HTMLTableElement();
for($i = 0; $i < 5; $i++) {
    $tr = new HTMLRowElement();
    for($j = 0; $j < 5; $j++) {
        $td = new HTMLCellElement("th");
        $td->add_child(new HTMLTextNode((string)($i+$j)));
        $tr->add_child($td);
    }
    $table->add_child($tr);
}
$body->add_child($table);

/* FORMA */
$form = new HTMLFormElement();
$form->add_attribute(new HTMLAttribute("action", "formTest.php"));
$input = new HTMLInputElement();
$input->add_attribute(new HTMLAttribute("type", "submit"));
$input->add_attribute(new HTMLAttribute("value","Press it!"));
$form->add_child($input);
$body->add_child($form);


$html->add_children(new HTMLCollection([$head, $body]));
echo $html->get_html();

?>
