<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Interfaces\Traits;

use MichaelRushton\SQL\Interfaces\Components\SubqueryInterface;

interface CanConvertToSubquery
{
    public function toSubquery(): SubqueryInterface;
}
