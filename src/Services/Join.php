<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\On;
use Stringable;

class Join implements Stringable, HasBindings
{

  use Bindings;
  use On;

  public function __construct(public readonly SQLInterface $sql) {}

  public function __toString(): string
  {

    if (empty($this->on))
    {
      return "";
    }

    $this->bindings = [];

    foreach ($this->on as [$operator, $condition])
    {

      $on[] = "$operator$condition";

      if ($condition instanceof HasBindings)
      {
        $this->mergeBindings($condition);
      }

    }

    $on = implode(" ", $on);

    return 1 === count($this->on) ? $on : "($on)";

  }

}