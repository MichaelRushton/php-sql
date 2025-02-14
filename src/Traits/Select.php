<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasAlias;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Expression;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait Select
{

  protected array $select = [];

  public function select(string|Stringable|int|float|bool|null|array $column): static
  {

    $columns = is_array($column) ? $column : [$column];

    foreach ($columns as $alias => $column)
    {

      $column = $this->sql->convert($column);

      if (is_string($alias))
      {

        if (!($column instanceof HasAlias))
        {
          $column = new Expression($this->sql, $column);
        }

        $column->as($alias);

      }

      $this->select[] = $column;

    }

    return $this;

  }

  public function selectRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->select(new Raw($expression, $bindings));
  }

  protected function getSelect(): string
  {

    if (empty($this->select))
    {
      return "*";
    }

    $select = implode(", ", $this->select);

    foreach ($this->select as $column)
    {

      if ($column instanceof HasBindings)
      {
        $this->mergeBindings($column);
      }

    }

    return $select;

  }

}