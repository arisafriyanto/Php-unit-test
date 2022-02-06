<?php

namespace Afriyan\Test;

use Exception;

class Person
{
    public function __construct(private string $name)
    {
    }

    public function sayHello(?string $name): string
    {
        if ($name == null) {
            throw new Exception("name is not null");
        }

        return "Hii, $this->name. my name is $name";
    }

    public function sayGoodBye(string $name): void
    {
        echo "Good Bye $name";
    }
}
