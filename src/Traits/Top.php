<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;
use Stringable;

trait Top
{

  protected string $percent = "";

  use RowCount;
  use WithTies;

  public function top(int|float|string|Stringable $row_count): static
  {

    $this->row_count = $row_count;

    return $this;

  }

  public function percent(): static
  {

    $this->percent = " PERCENT";

    return $this;

  }

  protected function getTop(): string
  {

    if ("" === $this->row_count || "" !== $this->offset)
    {
      return "";
    }

    $top = "TOP ($this->row_count)$this->percent$this->with_ties";

    if ($this->row_count instanceof HasBindings)
    {
      $this->mergeBindings($this->row_count);
    }

    return $top;

  }

}