<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Components\Subquery;
use MichaelRushton\SQL\Contracts\Components\SubqueryInterface;

trait ToSubquery
{
    public function toSubquery(): SubqueryInterface
    {
        return new Subquery($this);
    }

}
