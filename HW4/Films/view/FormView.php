<?php

namespace view;

class FormView extends AbstractView {


    public function generateHTML() {
        global $CONTENTS;

        start_form("./index.php?action=add", "post", "multipart/form-data");

        // Odjeljak s oznakama input-a
        $txtTitle = create_element("b", ["style" => "margin-left:10%", $CONTENTS => "Title"], true);
        $txtGenre = create_element("b", ["style" => "margin:8%", $CONTENTS => "Genre"], true);
        $txtYear = create_element("b", ["style" => "margin:3%", $CONTENTS => "Year"], true);
        $txtDuration = create_element("b", ["style" => "margin:4%", $CONTENTS => "Duration"], true);
        $txtHeadline = create_element("b", ["style" => "margin:13%", $CONTENTS => "Headline"], true);
        $txtAdd = create_element("b", ["style" => "margin:3%", $CONTENTS => "Add"], true);
        $divTxt = create_element("div", ["style" => "padding:5px",
                            $CONTENTS => [$txtTitle, $txtGenre, $txtYear, $txtDuration, $txtHeadline, $txtAdd]], true);

        echo $divTxt;


        // Title input
        $inputTitle = create_input(["type" => "input", "name" => "name", "style" => "margin-left:7.5%"]);

        // Genre input
        $modelGenre = new \model\Genre();
        $genres = $modelGenre->getAll();
        $options = [];
        foreach($genres as $genre) {
            $option = create_element("option", ["value" => $genre, $CONTENTS => $genre], true);
            array_push($options, $option);
        }
        $selectGenre = create_select(["name" => "genre","style" => "margin-left:4%", $CONTENTS => $options]);

        // Year input
        $options = [];
        $years = range(2020, 1900, -1);
        foreach($years as $year) {
            $option = create_element("option", ["value" => $year, $CONTENTS => $year], true);
            array_push($options, $option);
        }
        $selectYear = create_select(["name" => "year", "style" => "margin-left:9%", $CONTENTS => $options]);

        // Duration input
        $inputDuration = create_input(["type" => "number", "min" => "10", "max" => "300",
                                        "style" => "margin-left:5.5%;width:5%", "name" => "duration"]);

        // Cover input
        $cover = create_input(["type" => "file", "name" => "headlineImg", "style" => "margin-left:14%"]);

        // Submit button
        $submit = create_input(["type" => "submit", "name" => "addMovie",
                                "style" => "margin-left:7.5%", "value" => "Add Movie"]);

        $divInput = create_element("div", ["style" => "padding:12px 0;border-bottom:2px solid darkgrey",
                        $CONTENTS => [$inputTitle, $selectGenre, $selectYear, $inputDuration, $cover, $submit]], true);

        echo $divInput;

        end_form();
    }

}
