<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use Stringable;

trait Table
{

  protected array $table = [];

  public function table(string|Stringable|array $table): static
  {

    $tables = is_array($table) ? $table : [$table];

    foreach ($tables as $table)
    {
      $this->table[] = $table;
    }

    return $this;

  }

  protected function getTable(): string
  {

    if (empty($this->table))
    {
      return "";
    }

    $table = implode(", ", $this->table);

    foreach ($this->table as $t)
    {

      if ($t instanceof HasBindings)
      {
        $this->mergeBindings($t);
      }

    }

    return $table;

  }

}