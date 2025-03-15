<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts;

interface HasAlias
{
  public function as(?string $name): static;
}