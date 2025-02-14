<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts;

use Stringable;

interface CanConvertToSubquery
{
  public function toSubquery(): Stringable & HasAlias;
}