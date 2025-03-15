<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait Table
{

  protected array $table = [];

  public function table(string|Stringable|array $table): static
  {

    $tables = is_array($table) ? $table : [$table];

    foreach ($tables as $alias => $table)
    {
      $this->table[] = $this->sql->toTable($table, $alias);
    }

    return $this;

  }

  public function tableRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->table(new Raw($expression, $bindings));
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