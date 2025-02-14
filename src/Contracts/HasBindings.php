<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts;

interface HasBindings
{
  public function bindings(): array;
}