<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Where as TraitsWhere;
use Stringable;

class Where implements HasBindings, Stringable
{

  use Bindings;
  use TraitsWhere;

  public function __toString(): string
  {

    if (empty($this->where))
    {
      return "";
    }

    $this->bindings = [];

    foreach ($this->where as [$prefix, $predicate])
    {

      $where[] = "$prefix$predicate";

      if ($predicate instanceof HasBindings)
      {
        $this->mergeBindings($predicate);
      }

    }

    $where = implode(" ", $where);

    return 1 === count($this->where) ? $where : "($where)";

  }

}