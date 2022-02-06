<?php

namespace Afriyan\Test;

class Math
{
    public static function sum(array $values): int
    {
        $total = 0;
        foreach ($values as $value) {
            $total = $total + $value;
        }

        return $total;
    }
}
