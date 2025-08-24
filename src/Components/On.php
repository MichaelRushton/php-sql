<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\On as TraitsOn;
use Stringable;

class On implements HasBindings, Stringable
{
    use Bindings;
    use TraitsOn;

    public function __toString(): string
    {

        if (empty($this->on)) {
            return "";
        }

        $this->bindings = [];

        foreach ($this->on as [$prefix, $predicate]) {

            $on[] = "$prefix$predicate";

            if ($predicate instanceof HasBindings) {
                $this->mergeBindings($predicate);
            }

        }

        $on = implode(" ", $on);

        return 1 === count($this->on) ? $on : "($on)";

    }

}
