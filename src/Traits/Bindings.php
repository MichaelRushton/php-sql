<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;

trait Bindings
{

  protected array $bindings = [];

  public function bindings(): array
  {
    return $this->bindings;
  }

  public function mergeBindings(HasBindings $from): static
  {

    foreach ($from->bindings() as $binding)
    {
      $this->bindings[] = $binding;
    }

    return $this;

  }

}