<?php

namespace App;

class MatrixOperation
{
    protected array $A;
    protected array $B;
    protected array $lastResult = [];

    /* 
    * В конструктор можно передать значения матриц для операций над ними
    */
    public function __construct(array $A = [], array $B = [])
    {
        $this->A = $A;
        $this->B = $B;
    }

    /* 
    * Суммирование с проверками
    */
    public function sum(array $A = [], array $B = []): MatrixOperation | string
    {
        // Если матрицы не заданы присваивание данных из конструктора
        $A = empty($A) ? $this->A : $A;
        $B = empty($B) ? $this->B : $B;

        // Запуск проверок и вызов рекурсивной функции
        $check = $this->performChecks($A, $B);
        if ($check === true) {
            $this->lastResult = $this->sumRecursive($A, $B);
            return $this;
        }
        // Вывод текста ошибки
        return $check;
    }

    /* 
    * Рекурсивное суммирование матриц
    */
    private function sumRecursive($A, $B): callable | array
    {

        $item = function ($aRow, $bRow) use (&$item) {

            //Если вложенные элементы массивов не массивы, суммировать
            if (!is_array($aRow) && !is_array($bRow)) {
                return $aRow + $bRow;
            }

            //Рекурсивный вызов для вложенных массивов
            return array_map(function ($a, $b) use ($item) {
                return $item($a, $b);
            }, $aRow, $bRow);
        };

        // Вызов рекурсивной функции
        return $item($A, $B);
    }

    /* 
    * Вычитание матриц с проверками, возращает сам объект для дальнейшего взаимодействия
    */
    public function subtract(array $A = [], array $B = []): MatrixOperation | string
    {
        // Если матрицы не заданы присваивание данных из конструктора
        $A = empty($A) ? $this->A : $A;
        $B = empty($B) ? $this->B : $B;

        // Запуск проверок и вызов рекурсивной функции
        $check = $this->performChecks($A, $B);
        if ($check === true) {
            $this->lastResult = $this->subtractRecurisve($A, $B);
            return $this;
        }

        // Вывод текста ошибки
        return $check;
    }

    /* 
    * Рекурсивное вычитание матриц
    */
    private function subtractRecurisve($A, $B): callable | array
    {
        $item = function ($aRow, $bRow) use (&$item) {

            //Если вложенные элементы массивов не массивы, вычесть
            if (!is_array($aRow) && !is_array($bRow)) {
                return $aRow - $bRow;
            }
    
            //Рекурсивный вызов для вложенных массивов
            return array_map(function ($a, $b) use ($item) {
                return $item($a, $b);
            }, $aRow, $bRow);
        };
    
        // Вызов рекурсивной функции
        return $item($A, $B);
    }

    /* 
    * Вызов объекта как строки, печать результата операции
    */
    public function __toString(): string
    {
        $print = '';
        // Печать строк массива или строки 1-мерного массива
        if (is_array($this->lastResult[0])) {
            foreach ($this->lastResult as $row) {
                $print = $print . "|" . implode(" ", $row) . "|\n";
            }
        } else {
            $print = $print . "|" . implode(" ", $this->lastResult) . "|\n";
        }
        return $print;
    }

    /* 
    * Проверка размерностей матриц, если размерности разные, операция невозможна
    */
    private function haveEqualDimensions(array $A, array $B): bool
    {
        // Запись числа элементов в строке и в столбце с учетом возможности 1-мерного массива
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
    
        // Сравнение числа строк и столбцов
        return ($rowsA === $rowsB) && ($colsA === $colsB);
    }

    /* 
    * Проверка является ли массив матрицей (число столбцов одинаково в каждой из строк)
    */
    private function isMatrix(array $A): bool
    {
        // Если массив 1-мерный
        if(!is_array($A[0])) {
            return count($A) > 0;
        }

        // Число столбцов в первой строке
        $cols = count($A[0]);

        // Сравнение числа столбцов в 1 строке и в других строках
        foreach ($A as $row) {
            if (count($row) !== $cols) {
                return false;
            }
        }
        return true;
    }

    /* 
    * Запуск проверок и вывод текста ошибки в случае провала проверки
    */
    private function performChecks($A, $B): bool | string
    {
        if (empty($A) || empty($B)) {
            return 'Ошибка: матрицы пустые или не заданы' . PHP_EOL;
        }
        if (!$this->isMatrix($A) || !$this->isMatrix($B)) {
            return 'Ошибка: хотя бы один из массивов неправильной формы (не является матрицей)' . PHP_EOL;
        }
        if (!$this->haveEqualDimensions($A, $B)) {
            return 'Ошибка: у матриц разные размерности' . PHP_EOL;
        }
        return true;
    }
}