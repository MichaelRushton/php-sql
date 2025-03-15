<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait Alias
{

  protected string $alias = "";

  public function as(?string $alias): static
  {

    $this->alias = null !== $alias ? "AS " . $this->sql->quote($alias) : "";

    return $this;

  }

}