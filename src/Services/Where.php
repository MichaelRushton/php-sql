<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Where as TraitsWhere;
use Stringable;

class Where implements Stringable, HasBindings
{

  use Bindings;
  use TraitsWhere;

  public function __construct(public readonly SQLInterface $sql) {}

  public function __toString(): string
  {

    if (empty($this->where))
    {
      return "";
    }

    $this->bindings = [];

    foreach ($this->where as [$operator, $condition])
    {

      $where[] = "$operator$condition";

      if ($condition instanceof HasBindings)
      {
        $this->mergeBindings($condition);
      }

    }

    $where = implode(" ", $where);

    return 1 === count($this->where) ? $where : "($where)";

  }

}