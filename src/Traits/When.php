<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;

trait When
{
    public function when(
        mixed $condition,
        ?Closure $if_true = null,
        ?Closure $if_false = null
    ): static {

        if ($condition && $if_true) {
            $if_true->call($this, $condition, $this);
        } elseif (!$condition && $if_false) {
            $if_false->call($this, $condition, $this);
        }

        return $this;

    }

}
