<?php

namespace App;

require 'MatrixOperation.php';

$result = new MatrixOperation([1,2,3], [4,5,6]);
var_dump($result->sum());