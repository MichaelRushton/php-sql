<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use Stringable;

trait InsertSelect
{

  protected string|Stringable $select = "";

  public function select(string|Stringable|Closure $stmt): static
  {

    if ($stmt instanceof Closure)
    {
      $stmt($stmt = $this->sql->select());
    }

    $this->select = $stmt;

    return $this;

  }

  protected function getSelect(): string
  {

    $select = "$this->select";

    if ($this->select instanceof HasBindings)
    {
      $this->mergeBindings($this->select);
    }

    return $select;

  }

}