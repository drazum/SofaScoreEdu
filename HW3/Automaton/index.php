<?php
declare(strict_types=1);

require_once "src/Automaton.php";
require_once "src/DefaultAutomaton.php";

function prnt(string $s = "") : void {
    echo $s . "<br>\n";
}

Automaton::register("ime",
    new DefaultAutomaton("karlo"));

Automaton::register("brojevi",
    new DefaultAutomaton("12345"));

Automaton::register("mijesano",
    new DefaultAutomaton("\[12345\]"));

Automaton::register("SofaAutomation",
    new DefaultAutomaton("Sofa<broj><brojeviislova>Score",
    ["broj" => "\d+", "brojeviislova" => "[[:alnum:]]*"]));

Automaton::register("hex",
    new DefaultAutomaton("hex1:0x<hex>",
    ["hex" => "[[:xdigit:]]+$"]));

Automaton::register("const",
    new DefaultAutomaton("<velikaslovapodvlakabroj>=<broj>",
    ["velikaslovapodvlakabroj" => "[[:upper:]_]+\d*", "broj" => "[[:digit:]]+"]));

Automaton::register("simplemail",
    new DefaultAutomaton("My email is: <email>",
        ["email" => "[a-zA-Z0-9\._\%\+\-]+\@[a-zA-Z0-9\.\-]+\.[A-Za-z]{2,64}"]));

Automaton::register("password",
    new DefaultAutomaton("<password>",
    ["password" => "(?=[^a-z]*[a-z])(?=[^\d*\d]).{8,}"]));


$test = ["a", "karlo", "132456", "[12345]",
    "SofaScore", "Sofa10Score",
    "Sofa2020EducationScore", "hex1:0xFA01", "hex1:0xR21",
    "SNAKE_CASE1=123", "1SNAKE_=54", "domagoj", "TabulaRasa1",
    "My email is: domagoj.razum1@gmail.com"];

foreach ($test as $t) {
    $matched = null;
    /* @var Automaton $automaton */
    $automatonMap = Automaton::get();
    foreach ($automatonMap as $name => $automaton) {
        if (!$automaton->match($t)) {
            continue;
        }
        $matched = $name;
        break;
    }

    if (null == $matched) {
        prnt("None automaton matched $t");
    } else {
        prnt("Automaton " . $name . " matched $t");
    }
}

prnt(); prnt();

prnt(Automaton::get("ime")->generate());
prnt(Automaton::get("SofaAutomation")
    ->generate(["broj" => "aaa"]));
prnt(Automaton::get("SofaAutomation")
    ->generate(["broj" => "100"]));
prnt(Automaton::get("SofaAutomation")
    ->generate(["broj" => "100", "brojeviislova" => "Radi"]));
prnt(Automaton::get("hex")->generate(["hex" => "FFFF"]));
prnt(Automaton::get("hex")->generate(["hex" => "FFV"]));
prnt(Automaton::get("const")->generate(["velikaslovapodvlakabroj" => "1", "broj" => "1"]));
prnt(Automaton::get("const")->generate(["velikaslovapodvlakabroj" => "CONST_VALUE", "hex" => "1"]));
prnt(Automaton::get("simplemail")->generate(["email" => "jura.andric@inbox.com"]));
prnt(Automaton::get("simplemail")->generate(["email" => "jura.andricinbox.com"]));
prnt(Automaton::get("password")->generate(["password" => "neceIci"]));
prnt(Automaton::get("password")->generate(["broj" => "neceIci"]));
prnt(Automaton::get("password")->generate(["password" => "Password123"]));
