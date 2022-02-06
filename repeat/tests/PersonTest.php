<?php

namespace Afriyan\Test;

use Exception;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{

    //!8.0 Fixture setUp()

    private Person $person;

    /*
        protected function setUp(): void
        {
            $this->person = new Person("Aris");
        }
    */

    //!8.1 Fixture @before = setUp

    /**
     * @before
     */

    public function createPerson(): void
    {
        $this->person = new Person("Aris");
        echo "\nsetup counter\n";
    }


    public function testSayHelloSuccess(): void
    {
        $this->assertEquals("Hii, Aris. my name is Budi", $this->person->sayHello("Budi"));
    }


    //!6 TestException

    public function testException(): void
    {
        $this->expectException(Exception::class);
        $this->assertEquals("Hii, Aris. my name is Budi", $this->person->sayHello(null));
    }


    //!7 TestOutput

    /*
        public function testSayGoodBye(): void
        {
            $this->expectOutputString('Good Bye Budi');
            $this->person->sayGoodBye("Budi");
        }
    */

    //!8.2 Fixture tearDown()

    /*
        protected function tearDown(): void
        {
            echo "tear down\n";
        }
    */

    //!8.3 Fixture @after = tearDown()

    /**
     * @after
     */

    public function after(): void
    {
        echo "annotation after\n";
    }

    /*
        Independent Unit Test
        ● Secara default, class unit test itu sebenarnya akan selalu dibuat sebelum function unit test
        dijalankan, jadi tidak menggunakan object unit test yang sama
        ● Begini cara berjalan unit test :
        
        ○ membuat object unit test
        ○ menjalankan ﬁxture set up
        ○ menjalankan function unit test
        ○ menjalankan ﬁxture tear down
        ○ ulangi dari awal untuk function unit test selanjutnya
    */
}
