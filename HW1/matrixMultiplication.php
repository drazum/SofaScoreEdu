<?php
/**
 * Trenutno hardkodirane vrijednosti matrica i velicina (pokaznog oblika)
 */

/* Matricno mnozenje dvije ulancane matrice */
echo create_element("h1", true, ['contents' => ["5. Matrices multiplication"]]);
$matrixOne = [[1, 2, 3],[4, 5, 6]];
$matrixTwo = [[5, 8, 1],[3, 5, 6],[7, 1, 5]];

$resultMatrix = [];

foreach (range(1,2) as $row){
    foreach (range(1,3) as $col){
        $resultMatrix[$row-1][$col-1] = 0;
    }
}

create_table(['style' => 'display:inline-table;vertical-align:middle','border' => '1', 'width' => '60', 'height' => '60']);
for($i = 0; $i < 2; $i++){
    $matrixRow = ['contents' => []];
    for($j = 0; $j < 3; $j++){
        $matrixCell = create_table_cell(['style' => 'text-align:center','contents' => $matrixOne[$i][$j]]);
        array_push($matrixRow['contents'], $matrixCell);
    }
    echo create_table_row($matrixRow);
    unset($matrixRow);
}
end_table();

echo create_element("p", true, ['style' => 'display:inline;font-size:20px', 'contents' => [' * ']]);

create_table(['style' => 'display:inline-table;vertical-align:middle','border' => '1', 'width' => '60', 'height' => '60']);
for($i = 0; $i < 3; $i++){
    $matrixRow = ['contents' => []];
    for($j = 0; $j < 3; $j++){
        $matrixCell = create_table_cell(['style' => 'text-align:center','contents' => $matrixTwo[$i][$j]]);
        array_push($matrixRow['contents'], $matrixCell);
    }
    echo create_table_row($matrixRow);
    unset($matrixRow);
}
end_table();

echo create_element("p", true, ['style' => 'display:inline;font-size:20px', 'contents' => [' = ']]);

create_table(['style' => 'display:inline-table;vertical-align:middle','border' => '1']);
for($i=0;$i<2;$i++) { // redak1
    $tableMatrixRow = ['contents' => []];
    for($k=0;$k<3;$k++) { // stupac2
        for($j=0;$j<3;$j++) { // stupac1 i redak2
            $resultMatrix[$i][$k] += $matrixOne[$i][$j]*$matrixTwo[$j][$k];
        }
        $tableMatrixCell = create_table_cell(['style' => 'text-align:center','contents' => $resultMatrix[$i][$k]]);
        array_push($tableMatrixRow['contents'], $tableMatrixCell);
    }
    echo create_table_row($tableMatrixRow);
    unset($tableMatrixRow);
}
end_table();

?>