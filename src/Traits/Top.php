<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use Stringable;

trait Top
{

  protected int|float|string|Stringable $top = "";
  protected string $percent = "";

  use WithTies;

  public function top(int|float|string|Stringable $row_count): static
  {

    $this->top = $row_count;

    return $this;

  }

  public function percent(): static
  {

    $this->percent = " PERCENT";

    return $this;

  }

  protected function getTop(): string
  {

    if ("" === $this->top)
    {
      return "";
    }

    $top = "TOP ($this->top)$this->percent$this->with_ties";

    if ($this->top instanceof HasBindings)
    {
      $this->mergeBindings($this->top);
    }

    return $top;

  }

}