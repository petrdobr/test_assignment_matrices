<?php

namespace App;

require 'MatrixOperation.php';

$A0 = $B0 = [];
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
$A4 = [
    [1, 2, 3],
    [1],
];
$A5 = $B5 = [
    [1],
    [2],
    [3],
];

$matrix = new MatrixOperation();
//Normal operations
echo $matrix->sum($A1, $B1);
echo $matrix->sum($A2, $B2);
echo $matrix->sum($A3, $B3);
echo $matrix->subtract($A1, $B1);
echo $matrix->subtract($A2, $B2);
echo $matrix->subtract($A3, $B3);

//display errors
echo $matrix->sum($A0, $B0);
echo $matrix->sum($A1, $B2);
echo $matrix->sum($A4, $B2);
echo $matrix->subtract($A0, $B0);
echo $matrix->subtract($A1, $B2);
echo $matrix->subtract($A4, $B2);