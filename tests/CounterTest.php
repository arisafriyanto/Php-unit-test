<?php

namespace Afriyan\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;


//   Nama Class biasanya diikuti dengan Test dibelakangnya, dan dia extends ke childclass TestCase


class CounterTest extends TestCase
{
    // Nama method wajib didepannya kita kasih test contoh testCounter

    private Counter $counter;

    protected function setUp(): void
    {
        $this->counter = new Counter;
        echo "Panggil Counter Lagi \n";
    }

    /**
     * @requires OSFAMILY Windows
     */

    // skip
    public function testOnlyWindows(): void
    {
        self::assertTrue(true, "Only in Windows");
    }

    /**
     * @requires OSFAMILY Linux
     */
    public function testOnlyLinux(): void
    {
        // OSFAMILY = PHP_OS_FAMILY   
        self::assertTrue(true, "Only in Linux");
    }

    /**
     * requires PHP >=8
     * requires OSFAMILY Linux
     */
    public function testOnlyPHP8(): void
    {
        self::assertTrue(true, "Only PHP 8");
    }

    // skip
    public function testSkipped(): void
    {
        $this->markTestSkipped("This test skipped");
        // ini akan throw exception error SkippedTestError, dan dibawah ini tdk akan dijalankan, kita bisa  gunakan diatas supaya $this->markTestSkipped("This test skipped"); tidak dijalankan
        echo "skiped";
    }

    public function testIncrement(): void
    {
        self::assertEquals(0, $this->counter->getCounter());

        // menandai belum complete test
        self::markTestIncomplete("This is test incomplete");
        // ini akan throw exception error IncompleteTestError, dan dibawah ini tdk akan dijalankan, kita bisa  gunakan diatas supaya self::assertEquals(0, $this->counter->getCounter()); tidak dijalankan
        echo "Belum complete";
    }

    public function testCounter(): void
    {

        $this->counter->increment();
        Assert::assertEquals(1, $this->counter->getCounter());

        $this->counter->increment();
        $this->assertEquals(2, $this->counter->getCounter());


        $this->counter->increment();
        self::assertEquals(3, $this->counter->getCounter());
    }

    // public function testOther(): void
    // {
    //     echo "other" . PHP_EOL;
    // }

    /**
     * @test
     */

    public function increment(): void
    {
        $this->counter->increment();
        self::assertEquals(1, $this->counter->getCounter());
    }

    public function testFirst(): Counter
    {
        $this->counter->increment();
        self::assertEquals(1, $this->counter->getCounter());
        return $this->counter;
    }

    /**
     * @depends testFirst
     */
    public function testSecond(Counter $counter): void
    {
        $counter->increment();
        self::assertEquals(2, $counter->getCounter());
    }

    protected function tearDown(): void
    {
        echo "Tear Down\n";
    }

    /**
     * @after
     */
    public function after(): void
    {
        echo "After\n";
    }
}
