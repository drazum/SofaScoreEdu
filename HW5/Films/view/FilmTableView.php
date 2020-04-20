<?php

namespace view;

class FilmTableView extends AbstractView {

    private array $collection;

    public function __construct(array $collection) {
        $this->collection = $collection;
    }

    public function generateHTML() {
        global $CONTENTS;

        create_table(["align" => "center",
                        "style" => "text-align:center;width:100%;font-size:20px;border:1px solid black"]);

        // Stupac za slike
        $headerHeadline = create_element("th", ["style" => "border:1px solid black", $CONTENTS => "Headline"], true);

        // Stupac za imena filmova
        $sortLink = "./index.php?action=add&sort=name";
        $titleLink = create_element("a", ["href" => $sortLink, $CONTENTS => "Title"], true);
        $headerTitle = create_element("th", ["style" => "border:1px solid black", $CONTENTS => $titleLink], true);

        // Stupac za godine filmova
        $sortLink = "./index.php?action=add&sort=year";
        $yearLink = create_element("a", ["href" => $sortLink, $CONTENTS => "Year"], true);
        $headerYear = create_element("th", ["style" => "border:1px solid black", $CONTENTS => $yearLink], true);

        // Stupac za tranja filma
        $sortLink = "./index.php?action=add&sort=duration";
        $durationLink = create_element("a", ["href" => $sortLink, $CONTENTS => "Duration"], true);
        $headerDuration = create_element("th", ["style" => "border:1px solid black", $CONTENTS => $durationLink], true);

        // Stupac s linkovima za brisanje
        $headerAction = create_element("th", ["style" => "border:1px solid black", $CONTENTS => "Action"], true);

        echo create_table_row([$CONTENTS => [$headerHeadline, $headerTitle, $headerYear, $headerDuration, $headerAction]]);



        foreach ($this->collection as $movie) {
            // Slika filma
            $url = "./index.php?action=get&id=" . $movie["id"];
            $img = create_element("img", ["src" => $url, "style" => "width:214px;height:317px"], false);
            $coverImg =  create_table_cell(["style" => "border:1px solid black", $CONTENTS => $img]);

            // Ime filma
            $name = create_table_cell(["style" => "border:1px solid black", $CONTENTS => $movie["name"]]);

            // Godina snimanja filma
            $year = create_table_cell(["style" => "border:1px solid black", $CONTENTS => $movie["year"]]);

            // Trajanje filma
            $duration = create_table_cell(["style" => "border:1px solid black", $CONTENTS => $movie["duration"]]);

            // Link za brisanje filma
            $pageLink = "./index.php?action=delete&id=" . $movie["id"];
            $cellLink = create_element("a", ["href" => $pageLink, $CONTENTS => "[obriši]"], true);
            $delete = create_table_cell(["style" => "border:1px solid black", $CONTENTS => $cellLink]);

            echo create_table_row([$CONTENTS => [$coverImg, $name, $year, $duration, $delete]]);
        }

        end_table();

    }

}
