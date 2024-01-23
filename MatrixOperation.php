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

    public function haveEqualDimensions(array $A, array $B)
    {
        $rowsA = count($A);
        if (!is_array($A[0])) {
            $colsA = 1;
        } else {
            $colsA = count($A[0] ?? []);
        }
        
        $rowsB = count($B);
        if (!is_array($B[0])) {
            $colsB = 1;
        } else {
            $colsB = count($A[0] ?? []);
        }
    
        return ($rowsA === $rowsB) && ($colsA === $colsB);
    }

    public function isMatrix(array $A)
    {
        if(!is_array($A[0])) {
            return count($A) > 0;
        }
        $cols = count($A[0] ?? []);

        foreach ($A as $row) {
            if (count($row) !== $cols) {
                return false;
            }
        }
        return true;
    }

    public function sum(array $A = [], array $B = [])
    {
        $A = empty($A) ? $this->A : $A;
        $B = empty($B) ? $this->B : $B;
        if (empty($A) || empty($B)) {
            return 'Error: not specified matrices for the sum operation.';
        }
        if (!$this->isMatrix($A) || !$this->isMatrix($B)) {
            return 'Error: at least one input matrix has wrong shape';
        }
        if (!$this->haveEqualDimensions($A, $B)) {
            return 'Error: matrices have different dimensions.';
        }
        $item = function ($aRow, $bRow) use (&$item) {
            if (!is_array($aRow) && !is_array($bRow)) {
                return $aRow + $bRow;
            }
    
            return array_map(function ($a, $b) use ($item) {
                return $item($a, $b);
            }, $aRow, $bRow);
        };
    
        return $item($A, $B);
    }

    public function subtract(array $A = [], array $B = [])
    {
        $A = empty($A) ? $this->A : $A;
        $B = empty($B) ? $this->B : $B;
        if (empty($A) || empty($B)) {
            return 'Error: not specified matrices for the sum operation.';
        }
        if (!$this->isMatrix($A) || !$this->isMatrix($B)) {
            return 'Error: at least one input matrix has wrong shape';
        }
        if (!$this->haveEqualDimensions($A, $B)) {
            return 'Error: matrices have different dimensions.';
        }
        $item = function ($aRow, $bRow) use (&$item) {
            if (!is_array($aRow) && !is_array($bRow)) {
                return $aRow - $bRow;
            }
    
            return array_map(function ($a, $b) use ($item) {
                return $item($a, $b);
            }, $aRow, $bRow);
        };
    
        return $item($A, $B);
    }

}