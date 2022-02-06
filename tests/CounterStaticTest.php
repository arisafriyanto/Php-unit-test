<?php

namespace Afriyan\Test;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class CounterStaticTest extends TestCase
{
    static private Counter $counter;

    /*
        static public function setUpBeforeClass(): void
        {
            self::$counter = new Counter;
            echo "Set Up Before\n";
        }
    */

    /**
     * @beforeClass
     */
    static public function start(): void
    {
        self::$counter = new Counter;
        echo "Start\n";
    }

    public function testFirst(): void
    {
        self::$counter->increment();
        self::assertEquals(1, self::$counter->getCounter());
    }

    public function testSecond(): void
    {
        self::$counter->increment();
        self::assertEquals(2, self::$counter->getCounter());
    }

    public function testThird(): void
    {
        self::$counter->increment();
        self::assertEquals(3, self::$counter->getCounter());
    }

    /*
        static public function tearDownAfterClass(): void
        {
            echo "\nTear Down After\n";
        }
    */

    /**
     * @afterClass
     */
    static public function finish(): void
    {
        echo "\nFinish\n";
    }
}
