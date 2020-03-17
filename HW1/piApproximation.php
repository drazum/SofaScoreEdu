<?php

/* PI approximation, Leibniz formula */
echo create_element("h1", true, ['contents' => ["4. PI approximation using Leibniz formula"]]);

function calculate_pi($precision) : float {
    $sum = 0.;
    for($i = 0; $i < $precision; $i++){
        $sum += pow(-1, $i)/(2*$i + 1);
    }
    return $sum*4;
}

$boldText = create_element("b", true, ['contents' => ['PI approximation with 100000 iteration over Leibniz formula is: ']]);
echo create_element("p", true, ['style' => 'display:inline;font-size:20px',
    'contents' => [$boldText]]);

$approxPI = calculate_pi(100000);

echo create_element("p", true, ['style' => 'display:inline;color:coral;font-size:20px', 'contents' => [$approxPI]]);

?>