<?php

namespace Afriyan\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;

class CounterTest extends TestCase
{
    //!2 annotation

    /**
     * @test
     */

    public function increment(): void
    {
        $counter = new Counter;

        //!1 assertions

        $counter->increment();
        Assert::assertEquals(1, $counter->getCounter(), "failed nich!");

        $counter->increment();
        $this->assertEquals(2, $counter->getCounter(), "failed nich!");

        $counter->increment();
        self::assertEquals(3, $counter->getCounter(), "failed nich!");
    }

    /**
     * !3 Test Dependency
     *!Perhatian
     *● Unit test yang baik harus independen
     *● Tidak tergantung dengan unit test lainnya
     *● Jika kita membuat unit test yang tergantung dengan unit test lain, maka jika unit test sebelumnya error, maka unit test kita juga akan error
     */

    public function testFirst(): Counter
    {
        $counter = new Counter;
        $counter->increment();
        $this->assertEquals(1, $counter->getCounter());

        return $counter;
    }

    /**
     * @depends testFirst
     */

    public function testSecond(Counter $counter): void
    {
        $counter->increment();
        $this->assertEquals(2, $counter->getCounter());
    }
}
