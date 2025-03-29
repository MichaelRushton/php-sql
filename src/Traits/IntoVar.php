<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait IntoVar
{

  protected array $into_var = [];

  public function intoVar(string|array $name): static
  {

    foreach ((array) $name as $n)
    {
      $this->into_var[] = "@$n";
    }

    return $this;

  }

  protected function getIntoVar(): string
  {

    if (empty($this->into_var))
    {
      return "";
    }

    $into_var = implode(", ", $this->into_var);

    return "INTO $into_var";

  }

}