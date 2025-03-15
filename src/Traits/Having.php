<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Having as ServicesHaving;
use MichaelRushton\SQL\Services\Predicate;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait Having
{

  protected array $having = [];

  public function having(
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
      return $this->havingArray($column, $or, $not);
    }

    if ($column instanceof Closure)
    {
      $column($having = new ServicesHaving($this->sql));
    }

    else
    {
      $having = new Predicate($this->sql, $column, $operator, $value, $num_args + 1);
    }

    $conjunction = empty($this->having) ? "" : ($or ? "OR " : "AND ");

    $not = $not ? "NOT " : "";

    $this->having[] = ["$conjunction$not", $having];

    return $this;

  }

  protected function havingArray(
    array $expressions,
    bool $or,
    bool $not
  ): static
  {

    foreach ($expressions as $key => $expression)
    {
      $this->having($key, $expression, or: $or, not: $not, num_args: 2);
    }

    return $this;

  }

  public function orHaving(
    string|Stringable|int|float|bool|null|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {
    return $this->having($column, $operator, $value, or: true, num_args: func_num_args());
  }

  public function havingNot(
    string|Stringable|int|float|bool|null|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {
    return $this->having($column, $operator, $value, not: true, num_args: func_num_args());
  }

  public function orHavingNot(
    string|Stringable|int|float|bool|null|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {
    return $this->having($column, $operator, $value, or: true, not: true, num_args: func_num_args());
  }

  public function havingBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static
  {
    return $this->having($column, "BETWEEN", [$value1, $value2]);
  }

  public function orHavingBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static
  {
    return $this->having($column, "BETWEEN", [$value1, $value2], or: true, num_args: 3);
  }

  public function havingNotBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static
  {
    return $this->having($column, "BETWEEN", [$value1, $value2], not: true, num_args: 3);
  }

  public function orHavingNotBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static
  {
    return $this->having($column, "BETWEEN", [$value1, $value2], or: true, not: true, num_args: 3);
  }

  public function havingRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->having(new Raw($expression, $bindings));
  }

  public function orHavingRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orHaving(new Raw($expression, $bindings));
  }

  public function havingNotRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->havingNot(new Raw($expression, $bindings));
  }

  public function orHavingNotRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orHavingNot(new Raw($expression, $bindings));
  }

  protected function getHaving(): string
  {

    if (empty($this->having))
    {
      return "";
    }

    foreach ($this->having as [$operator, $expression])
    {

      $having[] = "$operator$expression";

      if ($expression instanceof HasBindings)
      {
        $this->mergeBindings($expression);
      }

    }

    $having = implode(" ", $having);

    return "HAVING $having";

  }

}