<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\OnConstraint;
use MichaelRushton\SQL\Traits\Set;
use MichaelRushton\SQL\Traits\Where;
use MichaelRushton\SQL\Traits\WhereIndex;
use Stringable;

class Upsert implements Stringable, HasBindings
{

  use Bindings;
  use Columns;
  use OnConstraint;
  use Set;
  use Where;
  use WhereIndex;

  public function __construct(public readonly SQLInterface $sql) {}

  public function __toString(): string
  {

    $this->bindings = [];

    return implode(" ", array_filter([
      $this->getColumns(),
      $this->getWhereIndex(),
      $this->on_constraint,
      "DO",
      empty($this->set) ? "NOTHING" : "UPDATE",
      $this->getSet(),
      $this->getWhere(),
    ], "strlen"));

  }

}