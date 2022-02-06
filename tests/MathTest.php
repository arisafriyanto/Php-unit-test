<?php

namespace Afriyan\Test;

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    /* Tanpa Data provider */

    public function testManual()
    {
        $math = new Math;
        self::assertEquals(10, $math::sum([5, 5]));
        self::assertEquals(100, $math::sum([50, 50]));
        self::assertEquals(58, $math::sum([5, 53]));
        self::assertEquals(20, $math::sum([15, 5]));
        self::assertEquals(7, $math::sum([2, 5]));
    }

    public function mathSumData(): array
    {
        return [
            [[5, 5], 10],
            [[50, 50], 100],
            [[55, 5], 60],
        ];
    }

    /**
     * @dataProvider mathSumData
     */

    public function testDataProvider(array $values, int $expected)
    {
        self::assertEquals($expected, Math::sum($values));
    }

    /**
     * @testWith [[5,5], 10]
     *           [[10,5], 15]
     */

    public function testWith(array $values, int $excepted)
    {
        self::assertEquals($excepted, Math::sum($values));
    }
}
