<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services;

use MichaelRushton\SQL\Contracts\HasAlias;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Traits\Alias;
use MichaelRushton\SQL\Traits\Bindings;
use Stringable;

class Expression implements Stringable, HasBindings, HasAlias
{

  use Alias;
  use Bindings;

  public function __construct(
    public readonly SQLInterface $sql,
    protected string|Stringable|int|float $expression
  ) {}

  protected function getExpression(): string
  {

    $expression = "$this->expression";

    if ($this->expression instanceof HasBindings)
    {
      $this->mergeBindings($this->expression);
    }

    return $expression;

  }

  public function __toString(): string
  {

    $this->bindings = [];

    return implode(" ", array_filter([
      $this->getExpression(),
      $this->alias,
    ], "strlen"));

  }

}