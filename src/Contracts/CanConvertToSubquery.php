<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts;

use MichaelRushton\SQL\Services\Subquery;

interface CanConvertToSubquery
{
  public function toSubquery(): Subquery;
}