<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Components\Subquery;
use MichaelRushton\SQL\Interfaces\Components\SubqueryInterface;

trait ToSubquery
{
    public function toSubquery(): SubqueryInterface
    {
        return new Subquery($this);
    }

}
