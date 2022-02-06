<?php

namespace Afriyan\Test;

use Exception;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    private Person $person;

    protected function setUp(): void
    {
    }

    /**
     * @before
     */
    public function createPerson(): void
    {
        $this->person = new Person("Aris");
    }

    /**
     * @test
     */
    public function success(): void
    {
        self::assertEquals("Hello Endang, my name is Aris",  $this->person->sayHello("Endang"));
    }

    public function testException(): void
    {
        $this->expectException(Exception::class);
        $this->person->sayHello(null);
    }

    public function testSayGoodBye(): void
    {
        $this->expectOutputString("Good Bye Endang");
        $this->person->sayGoodBye("Endang");
    }
}
