<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use Stringable;

trait Select
{
    protected string|Stringable $select = "";

    public function select(string|Stringable|Closure $stmt): static
    {

        if ($stmt instanceof Closure) {
            $stmt->call($stmt = $this->sql()->select(), $stmt);
        }

        $this->select = $stmt;

        return $this;

    }

    protected function getSelect(): string
    {

        $select = "$this->select";

        if ($this->select instanceof HasBindings) {
            $this->mergeBindings($this->select);
        }

        return $select;

    }

}
