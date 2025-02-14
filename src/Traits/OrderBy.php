<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait OrderBy
{

  protected array $order_by = [];

  public function orderBy(
    string|Stringable|array $column,
    string $direction = ""
  ): static
  {

    $columns = is_array($column) ? $column : [$column];

    foreach ($columns as $column)
    {

      $column = is_string($column) ? $this->sql->quote($column) : $column;

      $this->order_by[] = [$column, $direction];

    }

    return $this;

  }

  public function orderByDesc(string|Stringable|array $column): static
  {
    return $this->orderBy($column, "DESC");
  }

  public function orderByNullsFirst(string|Stringable|array $column): static
  {
    return $this->orderBy($column, "ASC NULLS FIRST");
  }

  public function orderByNullsLast(string|Stringable|array $column): static
  {
    return $this->orderBy($column, "ASC NULLS LAST");
  }

  public function orderByDescNullsFirst(string|Stringable|array $column): static
  {
    return $this->orderBy($column, "DESC NULLS FIRST");
  }

  public function orderByDescNullsLast(string|Stringable|array $column): static
  {
    return $this->orderBy($column, "DESC NULLS LAST");
  }

  public function orderByRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orderBy(new Raw($expression, $bindings));
  }

  public function orderByDescRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orderByDesc(new Raw($expression, $bindings));
  }

  public function orderByNullsFirstRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orderByNullsFirst(new Raw($expression, $bindings));
  }

  public function orderByNullsLastRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orderByNullsLast(new Raw($expression, $bindings));
  }

  public function orderByDescNullsFirstRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orderByDescNullsFirst(new Raw($expression, $bindings));
  }

  public function orderByDescNullsLastRaw(
    string $column,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orderByDescNullsLast(new Raw($column, $bindings));
  }

  protected function getOrderBy(): string
  {

    if (empty($this->order_by))
    {
      return "";
    }

    foreach ($this->order_by as [$column, $direction])
    {

      $order_by[] = trim("$column $direction");

      if ($column instanceof HasBindings)
      {
        $this->mergeBindings($column);
      }

    }

    $order_by = implode(", ", $order_by);

    return "ORDER BY $order_by";

  }

}