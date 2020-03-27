<?php
require "libraries/htmllib.php";

if (isset($_GET['numberOfQuestions'])) {
    $numberOfQuestions = $_GET['numberOfQuestions'];
}

create_doctype();
begin_html();

begin_head();
    echo create_element('title', true, ['contents' => ["Best Quiz Ever"]]);
end_head();

begin_body(["style" => "background-color:DarkSlateGrey", "text" => "FloralWhite"]);

    echo create_element("h2", true, ["align" => "center", "contents" => "SofaQuiz"]);

    $correctAnswersSum = 0;
    for($i = 1; $i <= $numberOfQuestions; $i++) {
        if (isset($_GET["q1_".$i]) && isset($_GET["q1_".$i."_result"])){
            $userAnswer = $_GET["q1_".$i];
            $correctAnswer = $_GET["q1_".$i."_result"];

            if ($userAnswer === $correctAnswer) {
                $correctAnswersSum++;
            }
            $string = "User answered: <b>".htmlentities($userAnswer)."</b>, and correct answer is:<b>".htmlentities($correctAnswer)."</b><br>";
            echo "<br>";
            echo $string;
        }

        if (isset($_GET["q2_".$i]) && isset($_GET["q2_".$i."_result"])){
            $userAnswer = $_GET["q2_".$i];
            $correctAnswer = explode(",", $_GET["q2_".$i."_result"]);
            $correctAnswer = array_map('trim', $correctAnswer);
            sort($userAnswer);
            sort($correctAnswer);
            if($userAnswer === $correctAnswer) {
                $correctAnswersSum++;
            }
            $userAnswer = implode(", ", $userAnswer);
            $correctAnswer = implode(", ", $correctAnswer);
            $string = "User answered: <b>".htmlentities($userAnswer)."</b>, and correct answer is:<b>".htmlentities($correctAnswer)."</b><br>";
            echo "<br>";
            echo $string;
        }

        if (isset($_GET["q3_".$i]) && isset($_GET["q3_".$i."_result"])){
            $userAnswer = $_GET["q3_".$i];
            $correctAnswer = $_GET["q3_".$i."_result"];
            if(!strcasecmp($userAnswer, $correctAnswer)) {
                $correctAnswersSum++;
            }
            $string = "User answered: <b>".htmlentities($userAnswer)."</b>, and correct answer is:<b>".htmlentities($correctAnswer)."</b><br>";
            echo "<br>";
            echo $string;
            echo "<br>";
        }
    }
    $percetage = (float)($correctAnswersSum/$numberOfQuestions)*100;
    echo "You scored <b>".$correctAnswersSum."/".$numberOfQuestions."</b>, and that is: <b>".$percetage."%</b><br>";

    start_form("index.php", "get");
        echo "<br>";
        echo create_input(["type" => "submit", "value" => "Start all over!"]);
    end_form();

end_body();

end_html();


?>
