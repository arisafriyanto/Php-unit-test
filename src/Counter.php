<?php

namespace Afriyan\Test;

class Counter
{
    private int $counter = 0;

    public function increment(): void
    {
        $this->counter = $this->counter + 1;
    }

    public function getCounter(): int
    {
        return $this->counter;
    }
}
