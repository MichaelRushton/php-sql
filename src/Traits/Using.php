<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait Using
{

  protected array $using = [];

  public function using(string|Stringable|array $table): static
  {

    $tables = is_array($table) ? $table : [$table];

    foreach ($tables as $alias => $table)
    {
      $this->using[] = $this->sql->toTable($table, $alias);
    }

    return $this;

  }

  public function usingRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->using(new Raw($expression, $bindings));
  }

  protected function getUsing(): string
  {

    if (empty($this->using))
    {
      return "";
    }

    $using = implode(", ", $this->using);

    foreach ($this->using as $table)
    {

      if ($table instanceof HasBindings)
      {
        $this->mergeBindings($table);
      }

    }

    return "USING $using";

  }

}