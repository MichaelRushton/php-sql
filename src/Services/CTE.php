<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\Cycle;
use MichaelRushton\SQL\Traits\CycleRestrict;
use MichaelRushton\SQL\Traits\Materialized;
use MichaelRushton\SQL\Traits\Search;
use Stringable;

abstract class CTE implements Stringable, HasBindings
{

  protected SQLInterface $sql;
  protected string|Stringable $stmt;

  use Bindings;
  use Columns;
  use Cycle;
  use CycleRestrict;
  use Materialized;
  use Search;

  public function __construct(
    protected string $name,
    string|Stringable|Closure $stmt
  )
  {

    $this->name = $this->sql->quote($name);

    if ($stmt instanceof Closure)
    {
      $stmt($stmt = $this->sql->select());
    }

    $this->stmt = $stmt;

  }

  protected function getStmt(): string
  {

    $stmt = "($this->stmt)";

    if ($this->stmt instanceof HasBindings)
    {
      $this->mergeBindings($this->stmt);
    }

    return $stmt;

  }

  abstract protected function toArray(): array;

  public function __toString(): string
  {

    $this->bindings = [];

    return implode(" ", array_filter($this->toArray()));

  }

}