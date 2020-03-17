<?php

/* Fibonacci */
echo create_element("h1", true, ['contents' => ["3. Fibonacci"]]);

function fibonacci($number):array {
    $fibonacciArr = [];
    $firstFibNum = 0;
    $secondFibNum = 1;
    for($i = 1; $i < $number; $i++){
        array_push($fibonacciArr, $firstFibNum);
        $FibNum = $firstFibNum + $secondFibNum;
        $firstFibNum = $secondFibNum;
        $secondFibNum = $FibNum;
    }
    return $fibonacciArr;
}

$boldTxt = create_element("b", true, ['contents' => ['First 50 Fibonacci numbers are: ']]);
echo create_element("p", true, ['style' => 'font-size:20px',
    'contents' => [$boldTxt]]);

$fibonacciNumbers = fibonacci(50);

foreach ($fibonacciNumbers as $num){
    echo create_element("p", true, ['style' => 'display:inline;font-size:20px;font-family:courier',
            'contents' => [$num]]).", ";
}

?>