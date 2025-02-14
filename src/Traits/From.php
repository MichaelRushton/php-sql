<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait From
{

  protected array $from = [];

  public function from(string|Stringable|array $table): static
  {

    $tables = is_array($table) ? $table : [$table];

    foreach ($tables as $alias => $table)
    {
      $this->from[] = $this->sql->toTable($table, $alias);
    }

    return $this;

  }

  public function fromRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->from(new Raw($expression, $bindings));
  }

  protected function getFrom(): string
  {

    if (empty($this->from))
    {
      return "";
    }

    $from = implode(", ", $this->from);

    foreach ($this->from as $table)
    {

      if ($table instanceof HasBindings)
      {
        $this->mergeBindings($table);
      }

    }

    return "FROM $from";

  }

}