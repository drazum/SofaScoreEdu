<?php

/* Prvih 100 prostih brojeva */
echo create_element("h1", true, ['contents' => ["2. Prime numbers"]]);

$tableRow = ['contents' => []];

$numbersToCheck = 100;
$primeFlag = true;
for($i = 2; $i <= $numbersToCheck; $i++){
    $primeFlag = true;

    for($j = 2; $j <= sqrt($i); $j++){
        if($i%$j == 0) {
            $primeFlag = false;
            break;
        }
    }
    if($primeFlag){
        $tableCell = create_table_cell(['style' => 'border:1px solid red;text-align:center', 'width' => '30','contents' => "$i"]);
        array_push($tableRow['contents'], $tableCell);
    }
}

create_table(['style' => 'padding:25px;border:1px solid black;border-collapse:collapse']);

echo create_table_row($tableRow);

end_table();

?>