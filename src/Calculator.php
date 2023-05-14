<?php

namespace App;

class Calculator
{
    /**
     * @param int|float $int
     * @param int|float $int1
     * @return float|int
     */
    public function addition(int|float $int, int|float $int1): int|float
    {
        return $int+ $int1;
    }

    /**
     * @param $int
     * @param $int1
     * @return mixed
     */
    public function subtraction($int, $int1)
    {
        return $int - $int1;
    }

    public function division($int, $int1)
    {
        return $int / $int1;
    }
}