<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasAlias;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Expression;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait Returning
{

  protected array $returning = [];

  public function returning(string|Stringable|int|float|bool|null|array $column = "*"): static
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

      $this->returning[] = $column;

    }

    return $this;

  }

  public function returningRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->returning(new Raw($expression, $bindings));
  }

  protected function getReturning(): string
  {

    if (empty($this->returning))
    {
      return "";
    }

    $returning = implode(", ", $this->returning);

    foreach ($this->returning as $column)
    {

      if ($column instanceof HasBindings)
      {
        $this->mergeBindings($column);
      }

    }

    return "RETURNING $returning";

  }

}