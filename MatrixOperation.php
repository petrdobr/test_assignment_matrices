<?php

namespace App;

class MatrixOperation
{
    protected array $A;
    protected array $B;

    public function __construct(array $A = [], array $B = [])
    {
        $this->A = $A;
        $this->B = $B;
    }

    public function isEmptyMatrix($A)
    {
        
    }

    public function haveEqualDimensions(array $A, array $B)
    {
        //check if dimensions are equal
    }

    public function sum(array $A = [], array $B = [])
    {
        $A = empty($A) ? $this->A : $A;
        $B = empty($B) ? $this->B : $B;
        if (empty($A) || empty($B)) {
            return 'Error: not specified matrices for the sum operation';
        }
        return 'SUM';
    }

}