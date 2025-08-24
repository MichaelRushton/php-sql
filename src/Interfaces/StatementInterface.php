<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Interfaces;

use Closure;

interface StatementInterface
{
    public function sql(): SQLInterface;

    public function when(
        mixed $condition,
        ?Closure $if_true = null,
        ?Closure $if_false = null
    ): static;

}
