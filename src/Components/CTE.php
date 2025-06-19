<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Components;

use MichaelRushton\SQL\Contracts\Components\CTEInterface;
use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\Cycle;
use MichaelRushton\SQL\Traits\CycleRestrict;
use MichaelRushton\SQL\Traits\Materialized;
use MichaelRushton\SQL\Traits\Search;
use Stringable;

class CTE implements CTEInterface, HasBindings, Stringable
{

  use Bindings;
  use Columns;
  use Cycle;
  use CycleRestrict;
  use Materialized;
  use Search;

  public function __construct(
    public readonly string $name,
    public readonly string|Stringable $stmt
  ) {}

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
      $this->name,
      $this->getColumns(),
      "AS",
      $this->materialized,
      $this->getStmt(),
      $this->getCycleRestrict(),
      $this->search,
      $this->cycle,
    ], "strlen"));

  }

}