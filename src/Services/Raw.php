<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Traits\Bindings;
use Stringable;

class Raw implements Stringable, HasBindings
{

  use Bindings;

  public function __construct(
    protected string $expression,
    string|int|float|bool|array $bindings = []
  )
  {

    foreach ((array) $bindings as $value)
    {
      $this->bindings[] = $value;
    }

  }

  public function __toString(): string
  {
    return $this->expression;
  }

}