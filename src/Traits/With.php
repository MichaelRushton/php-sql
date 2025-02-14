<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use Stringable;

trait With
{

  protected array $with = [];
  protected string $recursive = "";

  public function with(
    string $name,
    string|Stringable|Closure $stmt,
    ?Closure $callback = null,
  ): static
  {

    if ($stmt instanceof Closure)
    {
      $stmt($stmt = $this->sql->select());
    }

    $this->with[] = $cte = $this->sql->cte($name, $stmt);

    if ($callback)
    {
      $callback($cte);
    }

    return $this;

  }

  public function recursive(): static
  {

    $this->recursive = " RECURSIVE";

    return $this;

  }

  protected function getWith(): string
  {

    if (empty($this->with))
    {
      return "";
    }

    $with = implode(", ", $this->with);

    foreach ($this->with as $cte)
    {

      if ($cte instanceof HasBindings)
      {
        $this->mergeBindings($cte);
      }

    }

    return "WITH$this->recursive $with";

  }

}