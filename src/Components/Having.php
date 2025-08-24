<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Having as TraitsHaving;
use Stringable;

class Having implements HasBindings, Stringable
{
    use Bindings;
    use TraitsHaving;

    public function __toString(): string
    {

        if (empty($this->having)) {
            return "";
        }

        $this->bindings = [];

        foreach ($this->having as [$prefix, $predicate]) {

            $having[] = "$prefix$predicate";

            if ($predicate instanceof HasBindings) {
                $this->mergeBindings($predicate);
            }

        }

        $having = implode(" ", $having);

        return 1 === count($this->having) ? $having : "($having)";

    }

}
