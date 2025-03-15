<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Predicate;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\Where as ServicesWhere;
use Stringable;

trait Where
{

  protected array $where = [];

  public function where(
    string|Stringable|int|float|bool|null|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null,
    bool $or = false,
    bool $not = false,
    ?int $num_args = null
  ): static
  {

    $num_args ??= func_num_args();

    if (is_array($column) && 1 === $num_args)
    {
      return $this->whereArray($column, $or, $not);
    }

    if ($column instanceof Closure)
    {
      $column($where = new ServicesWhere($this->sql));
    }

    else
    {
      $where = new Predicate($this->sql, $column, $operator, $value, $num_args + 1);
    }

    $conjunction = empty($this->where) ? "" : ($or ? "OR " : "AND ");

    $not = $not ? "NOT " : "";

    $this->where[] = ["$conjunction$not", $where];

    return $this;

  }

  protected function whereArray(
    array $expressions,
    bool $or,
    bool $not
  ): static
  {

    foreach ($expressions as $key => $expression)
    {
      $this->where($key, $expression, or: $or, not: $not, num_args: 2);
    }

    return $this;

  }

  public function orWhere(
    string|Stringable|int|float|bool|null|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {
    return $this->where($column, $operator, $value, or: true, num_args: func_num_args());
  }

  public function whereNot(
    string|Stringable|int|float|bool|null|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {
    return $this->where($column, $operator, $value, not: true, num_args: func_num_args());
  }

  public function orWhereNot(
    string|Stringable|int|float|bool|null|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {
    return $this->where($column, $operator, $value, or: true, not: true, num_args: func_num_args());
  }

  public function whereBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static
  {
    return $this->where($column, "BETWEEN", [$value1, $value2]);
  }

  public function orWhereBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static
  {
    return $this->where($column, "BETWEEN", [$value1, $value2], or: true, num_args: 3);
  }

  public function whereNotBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static
  {
    return $this->where($column, "BETWEEN", [$value1, $value2], not: true, num_args: 3);
  }

  public function orWhereNotBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static
  {
    return $this->where($column, "BETWEEN", [$value1, $value2], or: true, not: true, num_args: 3);
  }

  public function whereRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->where(new Raw($expression, $bindings));
  }

  public function orWhereRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orWhere(new Raw($expression, $bindings));
  }

  public function whereNotRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->whereNot(new Raw($expression, $bindings));
  }

  public function orWhereNotRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orWhereNot(new Raw($expression, $bindings));
  }

  protected function getWhere(): string
  {

    if (empty($this->where))
    {
      return "";
    }

    foreach ($this->where as [$operator, $expression])
    {

      $where[] = "$operator$expression";

      if ($expression instanceof HasBindings)
      {
        $this->mergeBindings($expression);
      }

    }

    $where = implode(" ", $where);

    return "WHERE $where";

  }

}