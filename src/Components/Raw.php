<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use MichaelRushton\SQL\Traits\Bindings;
use Stringable;

class Raw implements HasBindings, Stringable
{
    use Bindings;

    public function __construct(
        public readonly string $expression,
        string|int|float|bool|null|array $bindings = []
    ) {

        $bindings = is_array($bindings) ? $bindings : [$bindings];

        foreach ($bindings as $value) {
            $this->bindings[] = $value;
        }

    }

    public function __toString(): string
    {
        return $this->expression;
    }

}
