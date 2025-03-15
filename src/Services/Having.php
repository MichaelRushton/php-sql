<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Having as TraitsHaving;
use Stringable;

class Having implements Stringable, HasBindings
{

  use Bindings;
  use TraitsHaving;

  public function __construct(public readonly SQLInterface $sql) {}

  public function __toString(): string
  {

    if (empty($this->having))
    {
      return "";
    }

    $this->bindings = [];

    foreach ($this->having as [$operator, $condition])
    {

      $having[] = "$operator$condition";

      if ($condition instanceof HasBindings)
      {
        $this->mergeBindings($condition);
      }

    }

    $having = implode(" ", $having);

    return 1 === count($this->having) ? $having : "($having)";

  }

}