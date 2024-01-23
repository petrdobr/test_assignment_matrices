<?php

namespace App;

require 'MatrixOperation.php';

$A0 = [];

$A1 = [
    [1, 2, 3],
    [1, 1, 1],
    [0, 0, 0],
];
$B1 = [
    [3, 2, 1],
    [4, 4, 4],
    [1, 2, 3],
];
$A2 = [1];
$B2 = [2];
$A3 = [1, 2, 3];
$B3 = [3, 2, 1];

$matrix = new MatrixOperation();
$sum = $matrix->sum($A2, $B2);
$subtr = $matrix->subtract($A2, $B2);
printResult($sum);


//print function
function printResult($result) {
    if (is_array($result[0] ?? null)) {
        foreach ($result as $row) {
            echo "[" . implode(" ", $row) . "]\n";
        }
    } else {
        echo "[" . implode(" ", $result) . "]\n";
    }
}
