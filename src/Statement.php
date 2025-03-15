<?php

declare(strict_types=1);

namespace MichaelRushton\SQL;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\When;
use Stringable;

abstract class Statement implements Stringable, HasBindings
{

  protected SQLInterface $sql;

  use Bindings;
  use When;

  abstract protected function toArray(): array;

  public function __toString(): string
  {

    $this->bindings = [];

    return implode(" ", array_filter($this->toArray(), "strlen"));

  }

}