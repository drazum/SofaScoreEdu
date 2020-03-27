<?php
    require_once "libraries/htmllib.php";
    create_doctype();
    begin_html();

    begin_head();
        echo create_element('title', true, ['contents' => ["Best Quiz Ever"]]);
    end_head();

    begin_body(["style" => "background-color:DarkSlateGrey", "text" => "FloralWhite"]);

        echo create_element("h2", true, ["align" => "center", "contents" => "SofaQuiz"]);

        start_form("formQuiz.php", "get");

            // todo: povecati font, razmaknuti dijelove..
            $oneAnswerLabel = create_element("label", true, ['contents' => "Enter number of questions with only one answer: "]);
            $oneAnswerInput = create_input(["type" => "text", "required" => "", "value" => "4", "name" => "oneAnswer"]);
            echo create_element("div", true, ["align" => "center", "contents" => [$oneAnswerLabel, $oneAnswerInput]]);

            $multiAnswersLabel = create_element("label", true, ['contents' => "Enter number of questions with multiple choice answer: "]);
            $multiAnswersInput = create_input(["type" => "text", "required" => "", "value" => "4", "name" => "multipleAnswers"]);
            echo create_element("div", true, ["align" => "center", "contents" => [$multiAnswersLabel, $multiAnswersInput]]);

            $txtAnswerLabel = create_element("label", true, ['contents' => "Enter number of questions with type in answer: "]);
            $txtAnswerInput = create_input(["type" => "text", "required" => "", "value" => "2", "name" => "txtAnswer"]);
            echo create_element("div", true, ["align" => "center", "contents" => [$txtAnswerLabel, $txtAnswerInput]]);

            $submitBtn = create_input(["type" => "submit", "value" => "Start quiz!"]);
            echo create_element("div", true, ["align" => "center", "contents" => $submitBtn]);

        end_form();

    end_body();

    end_html();

?>
