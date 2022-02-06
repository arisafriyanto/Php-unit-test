<?php

namespace Afriyan\Test;

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    //! Unit Test Math Manual

    public function testMathManual(): void
    {
        $this->assertEquals(2, Math::sum([1, 1]));
        $this->assertEquals(12, Math::sum([11, 1]));
        $this->assertEquals(10, Math::sum([8, 2]));
        $this->assertEquals(22, Math::sum([11, 11]));
        $this->assertEquals(4, Math::sum([0, 4]));
    }

    //!4 Unit Test Math With Data Provider

    /**
     * @dataProvider mathSumData
     */

    public function testDataProvider(array $values, $expected): void
    {
        $this->assertEquals($expected, Math::sum($values));
    }


    //! Function Data Provider Math

    public function mathSumData(): array
    {
        return [
            [[10, 1], 11],
            [[1, 1], 2],
            [[3, 1], 4],
            [[4, 3], 7],
            [[6, 6], 12],
        ];
    }

    //!5 Unit Test Math With Test With, without function

    /**
     * @testWith   [[2,5], 7]
     *             [[20,0], 20]
     */

    public function testWith(array $values, $expected): void
    {
        $this->assertEquals($expected, Math::sum($values));
    }
}
