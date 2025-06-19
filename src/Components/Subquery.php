<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Contracts\Components\SubqueryInterface;
use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\Traits\Alias;
use MichaelRushton\SQL\Traits\All;
use MichaelRushton\SQL\Traits\Any;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\Exists;
use MichaelRushton\SQL\Traits\In;
use MichaelRushton\SQL\Traits\Lateral;
use Stringable;

class Subquery implements SubqueryInterface, HasBindings, Stringable
{

  use Alias;
  use All;
  use Any;
  use Bindings;
  use Columns;
  use Exists;
  use In;
  use Lateral;

  public function __construct(protected string|Stringable $stmt) {}

  protected function getStmt(): string
  {

    $stmt = "($this->stmt)";

    if ($this->stmt instanceof HasBindings)
    {
      $this->mergeBindings($this->stmt);
    }

    return $stmt;

  }

  public function __toString(): string
  {

    $this->bindings = [];

    return implode(" ", array_filter([
      $this->all,
      $this->any,
      $this->exists,
      $this->in,
      $this->lateral,
      $this->getStmt(),
      $this->alias,
      $this->getColumns(),
    ], "strlen"));

  }

}