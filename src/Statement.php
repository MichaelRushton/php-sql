<?php

declare(strict_types=1);

namespace MichaelRushton\SQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Contracts\StatementInterface;
use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\Traits\Bindings;
use MichaelRushton\SQL\Traits\When;
use Stringable;

abstract class Statement implements StatementInterface, HasBindings, Stringable
{

  use Bindings;
  use When;

  public function __construct(
    protected SQLInterface $sql
  ) {}

  public function sql(): SQLInterface
  {
    return $this->sql;
  }

  abstract protected function toArray(): array;

  public function __toString(): string
  {

    $this->bindings = [];

    return implode(" ", array_filter($this->toArray(), "strlen"));

  }

}