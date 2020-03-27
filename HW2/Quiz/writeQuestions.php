<?php
declare(strict_types=1);

$questionCount = 0;

for($i = 0; $i < (int)$oneAnswer; $i++) {
    if(!array_key_exists($i, $typeOne["offeredAnswers"])) {
        break;
    }
    $questionCount++;
    echo create_element("p", true, ["contents" => $typeOne["question"][$i]]);

    $solution = $typeOne["correctAnswer"][$i];

    foreach ($typeOne["offeredAnswers"][$i] as $ans) {

        echo create_input(["type" => "radio", "name" => "q1_".$questionCount, "value" => $ans]);
        echo create_input(["type" => "hidden", "name" => "q1_".$questionCount."_result", "value" => $solution]);
        echo create_element("label", true, ['contents' => $ans]);
        echo "<br>";
    }
}

for($i = 0; $i < (int)$multipleAnswers; $i++) {
    if(!array_key_exists($i, $typeTwo["offeredAnswers"])) {
        break;
    }
    $questionCount++;
    echo create_element("p", true, ["contents" => $typeTwo["question"][$i]]);

    $solution = $typeTwo["correctAnswer"][$i];

    foreach ($typeTwo["offeredAnswers"][$i] as $ans) {

        echo create_input(["type" => "checkbox","name" => "q2_".$questionCount."[]", "value" => $ans]);
        echo create_input(["type" => "hidden", "name" => "q2_".$questionCount."_result", "value" => $solution]);
        echo create_element("label", true, ['contents' => $ans]);
    }
}

for($i = 0; $i < (int)$txtAnswers; $i++) {
    if(!array_key_exists($i, $typeThree["question"])) {
        break;
    }
    $questionCount++;
    echo create_element("p", true, ["contents" => $typeThree["question"][$i]]);

    $solution = $typeThree["correctAnswer"][$i];

    echo create_input(["type" => "text","name" => "q3_".$questionCount, "value" => ""]);
    echo create_input(["type" => "hidden", "name" => "q3_".$questionCount."_result", "value" => $solution]);
    echo "<br>";
}
?>
