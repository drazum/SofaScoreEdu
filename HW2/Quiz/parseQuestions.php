<?php

function readAndParseQuestions() : array {
    $FILENAME = "quiz_questions.txt";

    $quiestionsFile = fopen($FILENAME, "r") or die("Unable to open!");
    $lines = file($FILENAME);

    $oneAnswerData = ["question" => [], "offeredAnswers" => [], "correctAnswer" => []];
    $multipleAnswersData = ["question" => [], "offeredAnswers" => [], "correctAnswer" => []];
    $txtAnswerData = ["question" => [], "correctAnswer" => []];

    foreach ($lines as $line) {
        preg_match("/{(\d)}:/", $line, $typeNumber);
        // $typeNumber[0] je {x}:, a $typeNumber[1} je samo x

        if (!empty($typeNumber)) {
            [$question, $answers] = explode($typeNumber[0], $line);
            [$offeredAnswers, $correctAnswer] = explode("=", $answers);
            $offeredAnswers = explode(",", $offeredAnswers);

            $offeredAnswers = array_map('trim', $offeredAnswers);
            $correctAnswer = trim($correctAnswer);

            if ($typeNumber[1] === '1') {
                array_push($oneAnswerData["question"], $question);
                array_push($oneAnswerData["offeredAnswers"], $offeredAnswers);
                array_push($oneAnswerData["correctAnswer"], trim($correctAnswer));
            } else if ($typeNumber[1] === '2') {
                //$correctAnswer = explode(",", $correctAnswer);

                array_push($multipleAnswersData["question"], $question);
                array_push($multipleAnswersData["offeredAnswers"], $offeredAnswers);
                array_push($multipleAnswersData["correctAnswer"], $correctAnswer);

            } else if ($typeNumber[1] === '3') {
                array_push($txtAnswerData["question"], $question);
                array_push($txtAnswerData["correctAnswer"], $correctAnswer);
            }
        }
    }
    return [$oneAnswerData, $multipleAnswersData, $txtAnswerData];
}
?>
