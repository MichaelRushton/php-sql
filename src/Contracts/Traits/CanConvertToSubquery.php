<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Traits;

use MichaelRushton\SQL\Contracts\Components\SubqueryInterface;

interface CanConvertToSubquery
{
    public function toSubquery(): SubqueryInterface;
}
