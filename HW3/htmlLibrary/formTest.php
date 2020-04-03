<?php
declare(strict_types=1);

require_once "htmlLibrary.php";


$html = new HTMLHtmlElement();
$head = new HTMLHeadElement();
$body = new HTMLBodyElement();

$title = new HTMLTitleElement("Submit Button Page");
$body->add_attribute(new HTMLAttribute("bgcolor", "brown"));
$meta = new HTMLMetaElement();
$meta->add_attribute(new HTMLAttribute("charset", "UTF-8"));
$head->add_child($title);
$head->add_child($meta);

$div = new HTMLDivElement();
$p = new HTMLPElement();
$tekst = new HTMLTextNode("Submit obavljen, vrati se na pocetnu.");

$p->add_attribute(new HTMLAttribute("style", "font-size:30"));
$p->add_child($tekst);
$div->add_child($p);
$body->add_child($div);

$form = new HTMLFormElement();
$form->add_attribute(new HTMLAttribute("action", "index.php"));
$input = new HTMLInputElement();
$input->add_attribute(new HTMLAttribute("type", "submit"));
$input->add_attribute(new HTMLAttribute("value","Go back!"));
$form->add_child($input);
$body->add_child($form);


$html->add_children(new HTMLCollection([$head, $body]));
echo $html->get_html();