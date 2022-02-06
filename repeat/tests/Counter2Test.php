<?php

namespace Afriyan\Test;

use PHPUnit\Framework\TestCase;

class Counter2Test extends TestCase
{
    //!10 Incomplete Test

    /*
        Peringatan
        ● Menggunakan function markTestIncomplete() akan menghasilkan error IncompleteTestError
        ● Oleh karena itu, kode dibawahnya tidak akan dieksekusi

        Jadi jika markTestIncomplete di letakkan di atas assertions, assertions tdk akan dijalankan
    */

    private Counter $counter;

    public function setUp(): void
    {
        $this->counter = new Counter;
    }

    //? unit test belum selesai dan dianggap sukses

    public function testIncrement(): void
    {
        self::assertEquals(0, $this->counter->getCounter());

        //? menandai unit test belum selesai
        self::markTestIncomplete("This test has not been implemented yet.");
    }

    //!11 Skiped Test

    /*
        Peringatan
        ● Menggunakan function markTestSkipped() akan menghasilkan error SkippedTestError
        ● Oleh karena itu, kode dibawahnya tidak akan dieksekusi
    */

    //? Tanpa Skip Unit Test

    public function first(): void
    {
        self::assertEquals(0, $this->counter->getCounter());
        $this->counter->increment();
        self::assertEquals(1, $this->counter->getCounter());
    }

    //? dengan Skip Unit Test

    public function testSecond(): void
    {
        self::markTestSkipped("skipped test");

        self::assertEquals(0, $this->counter->getCounter());
        $this->counter->increment();
        self::assertEquals(1, $this->counter->getCounter());
    }

    //!12 Skipped test berdasarkan kondisi parameter @requires

    /**
     * @requires OSFAMILY Windows
     */

    public function testOnlyWindows(): void
    {
        self::assertTrue(true, "only in windows");
    }

    /**
     * @requires PHP >=8.0
     * @requires OSFAMILY Linux
     */

    public function testPhp8(): void
    {
        self::assertTrue(true, "only in Linux and PHP 8");
    }
}
