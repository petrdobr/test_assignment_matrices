<?php

namespace App;

require 'MatrixOperation.php';

$result = new MatrixOperation([1], [2]);
echo $result->sum([1], [2]);