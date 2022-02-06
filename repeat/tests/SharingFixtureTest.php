<?php

namespace Afriyan\Test;

use PHPUnit\Framework\TestCase;

class SharingFixtureTest extends TestCase
{
    //!9 Sharing Fixture
    /*
        Sharing Fixture
        ● Karena object dari class unit test selalu dibuat ulang, maka kadang agak menyulitkan jika
          kita ingin membuat data yang bisa di sharing antar unit test, misal koneksi database
        ● Untuk hal seperti ini, kita bisa membuat data nya berupa variable static, sehingga variable
          static tersebut tidak perlu tergantung dengan object unit test lagi        
    */

    private static Counter $counter;

    /*
        public static function setUpBeforeClass(): void
        {
            self::$counter = new Counter;
        }
    */

    //!9.1 annotation @beforeClass = setUpBeforeClass

    /**
     * @beforeClass
     */

    public static function beforeClass(): void
    {
        self::$counter = new Counter;
        echo "setup before class\n";
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

    //!9.2 tearDownAfterClass()

    public static function tearDownAfterClass(): void
    {
        echo "\ntear down after class\n";
    }


    /*
        Sharing ﬁxture hanya dieksekusi sekali diawal dan diakhir, walaupun di class unit test terdapat banyak function unit test
    */
}
