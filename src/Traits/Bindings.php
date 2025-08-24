<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Interfaces\Traits\HasBindings;

trait Bindings
{
    protected array $bindings = [];

    public function bindings(): array
    {
        return $this->bindings;
    }

    public function mergeBindings(HasBindings $from): void
    {

        foreach ($from->bindings() as $value) {
            $this->bindings[] = $value;
        }

    }

}
