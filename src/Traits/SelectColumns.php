<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use Stringable;

trait SelectColumns
{

  protected array $columns = [];

  public function columns(string|Stringable|int|float|array $columns): static
  {

    $columns = is_array($columns) ? $columns : [$columns];

    foreach ($columns as $column)
    {
      $this->columns[] = $column;
    }

    return $this;

  }

  protected function getColumns(): string
  {

    if (empty($this->columns))
    {
      return "*";
    }

    $columns = implode(", ", $this->columns);

    foreach ($this->columns as $column)
    {

      if ($column instanceof HasBindings)
      {
        $this->mergeBindings($column);
      }

    }

    return $columns;

  }

}