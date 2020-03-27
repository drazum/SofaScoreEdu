<?php
declare(strict_types=1);

require "libraries/htmllib.php";
require "parseQuestions.php";

create_doctype();

begin_html();

begin_head();
    echo create_element('title', true, ['contents' => ["Best Quiz Ever"]]);
end_head();

begin_body(["bgcolor" => "DarkSlateGrey", "text" => "FloralWhite"]);

    echo create_element("h2", true, ["align" => "center", "contents" => "SofaQuiz"]);

    start_form("index.php", "get");

        if(isset($_GET['oneAnswer']) && is_numeric($_GET['oneAnswer']) &&
            isset($_GET['multipleAnswers']) && is_numeric($_GET['multipleAnswers']) &&
            isset($_GET['txtAnswer']) && is_numeric($_GET['txtAnswer'])) {

            $oneAnswer = $_GET['oneAnswer'];
            $multipleAnswers = $_GET['multipleAnswers'];
            $txtAnswers = $_GET['txtAnswer'];
            [$typeOne, $typeTwo, $typeThree] = readAndParseQuestions();
        } else {

            echo create_element("p", true, ["align" => "center", "contents" => "Nisu dobro uneseni svi brojevi!"]);

            $backBtn = create_input(["type" => "submit", "align" => "center", "value" => "Go back!"]);
            echo create_element("div", true, ["align" => "center", "contents" => $backBtn]);
        }

    end_form();

    start_form("processQuizAnswers.php", "get");
        if(isset($typeOne) && isset($typeTwo) && isset($typeThree)){

            require_once "writeQuestions.php";
            echo create_input(["type" => "hidden", "name" => "numberOfQuestions", "value" => $questionCount]);
            echo "<br>";
            echo create_input(["type" => "submit", "value" => "Submit answers!"]);

        }

    end_form();

end_body();

end_html();
?>

