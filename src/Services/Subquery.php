<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use Closure;
use MichaelRushton\SQL\Contracts\HasAlias;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Alias;
use MichaelRushton\SQL\Traits\All;
use MichaelRushton\SQL\Traits\Any;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\Exists;
use MichaelRushton\SQL\Traits\ForSystemTime;
use MichaelRushton\SQL\Traits\In;
use MichaelRushton\SQL\Traits\Lateral;
use Stringable;

abstract class Subquery implements Stringable, HasBindings, HasAlias
{

  protected SQLInterface $sql;
  protected string|Stringable $stmt;

  use Alias;
  use All;
  use Any;
  use Bindings;
  use Columns;
  use Exists;
  use ForSystemTime;
  use In;
  use Lateral;

  public function __construct(string|Stringable|Closure $stmt)
  {

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