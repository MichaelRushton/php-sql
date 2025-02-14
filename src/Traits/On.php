<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Services\Join;
use MichaelRushton\SQL\Services\Predicate;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait On
{

  protected array $on = [];

  public function on(
    string|Stringable|int|float|bool|null|array|Closure $column1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null,
    bool $or = false,
    bool $not = false,
    ?int $num_args = null
  ): static
  {

    $num_args ??= func_num_args();

    if (is_array($column1) && 1 === $num_args)
    {
      return $this->onArray($column1, $or, $not);
    }

    if ($column1 instanceof Closure)
    {
      $column1($on = new Join($this->sql));
    }

    else
    {

      if (2 === $num_args && ++$num_args)
      {
        [$operator, $column2] = [null, $operator];
      }

      if (is_string($column2))
      {
        $column2 = new Raw($this->sql->quote($column2));
      }

      elseif (is_array($column2))
      {

        foreach ($column2 as &$c)
        {

          if (is_string($c))
          {
            $c = new Raw($this->sql->quote($c));
          }

        }

      }

      $on = new Predicate($this->sql, $column1, $operator, $column2, $num_args + 1);

    }

    $conjunction = empty($this->on) ? "" : ($or ? "OR " : "AND ");

    $not = $not ? "NOT " : "";

    $this->on[] = ["$conjunction$not", $on];

    return $this;

  }

  protected function onArray(
    array $expressions,
    bool $or,
    bool $not
  ): static
  {

    foreach ($expressions as $key => $expression)
    {
      $this->on($key, $expression, or: $or, not: $not, num_args: 2);
    }

    return $this;

  }

  public function orOn(
    string|Stringable|int|float|bool|null|array|Closure $column1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null
  ): static
  {
    return $this->on($column1, $operator, $column2, or: true, num_args: func_num_args());
  }

  public function onNot(
    string|Stringable|int|float|bool|null|array|Closure $column1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null
  ): static
  {
    return $this->on($column1, $operator, $column2, not: true, num_args: func_num_args());
  }

  public function orOnNot(
    string|Stringable|int|float|bool|null|array|Closure $column1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null
  ): static
  {
    return $this->on($column1, $operator, $column2, or: true, not: true, num_args: func_num_args());
  }

  public function onBetween(
    string|Stringable|int|float $column1,
    string|Stringable|int|float $column2,
    string|Stringable|int|float $column3
  ): static
  {
    return $this->on($column1, "BETWEEN", [$column2, $column3]);
  }

  public function orOnBetween(
    string|Stringable|int|float $column1,
    string|Stringable|int|float $column2,
    string|Stringable|int|float $column3
  ): static
  {
    return $this->on($column1, "BETWEEN", [$column2, $column3], or: true, num_args: 3);
  }

  public function onNotBetween(
    string|Stringable|int|float $column1,
    string|Stringable|int|float $column2,
    string|Stringable|int|float $column3
  ): static
  {
    return $this->on($column1, "BETWEEN", [$column2, $column3], not: true, num_args: 3);
  }

  public function orOnNotBetween(
    string|Stringable|int|float $column1,
    string|Stringable|int|float $column2,
    string|Stringable|int|float $column3
  ): static
  {
    return $this->on($column1, "BETWEEN", [$column2, $column3], or: true, not: true, num_args: 3);
  }

  public function onRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->on(new Raw($expression, $bindings));
  }

  public function orOnRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orOn(new Raw($expression, $bindings));
  }

  public function onNotRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->onNot(new Raw($expression, $bindings));
  }

  public function orOnNotRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->orOnNot(new Raw($expression, $bindings));
  }

}