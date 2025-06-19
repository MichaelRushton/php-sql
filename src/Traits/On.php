<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Components\On as ComponentsOn;
use MichaelRushton\SQL\Components\Predicate;
use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use Stringable;

trait On
{

  protected array $on = [];

  public function on(
    string|Stringable|int|float|bool|array|Closure $column1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null,
    bool $or = false,
    bool $not = false,
    ?int $num_args = null
  ): static
  {

    $num_args ??= func_num_args();

    if (is_array($column1))
    {
      return $this->onArray($column1, $or, $not);
    }

    if ($column1 instanceof Closure)
    {
      $column1->call($on = new ComponentsOn, $on);
    }

    else
    {

      if (2 === ($num_args ??= func_num_args()) && ++$num_args)
      {
        [$operator, $column2] = [null, $operator];
      }

      if (is_array($column2 = SQL::identifier($column2)))
      {

        foreach ($column2 as &$c)
        {
          $c = is_scalar($c) ? new Raw("$c") : $c;
        }

      }

      elseif (is_scalar($column2))
      {
        $column2 = new Raw("$column2");
      }

      $on = new Predicate($column1, $operator, $column2, $num_args);

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
    string|Stringable|int|float|bool|array|Closure $column1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null
  ): static
  {
    return $this->on($column1, $operator, $column2, or: true, num_args: func_num_args());
  }

  public function onNot(
    string|Stringable|int|float|bool|array|Closure $column1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null
  ): static
  {
    return $this->on($column1, $operator, $column2, not: true, num_args: func_num_args());
  }

  public function orOnNot(
    string|Stringable|int|float|bool|array|Closure $column1,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null
  ): static
  {
    return $this->on($column1, $operator, $column2, or: true, not: true, num_args: func_num_args());
  }

  public function onIn(
    string|Stringable|int|float|bool $column1,
    array $columns
  ): static
  {
    return $this->on($column1, "IN", $columns);
  }

  public function orOnIn(
    string|Stringable|int|float|bool $column1,
    array $columns
  ): static
  {
    return $this->on($column1, "IN", $columns, or: true, num_args: 3);
  }

  public function onNotIn(
    string|Stringable|int|float|bool $column1,
    array $columns
  ): static
  {
    return $this->on($column1, "IN", $columns, not: true, num_args: 3);
  }

  public function orOnNotIn(
    string|Stringable|int|float|bool $column1,
    array $columns
  ): static
  {
    return $this->on($column1, "IN", $columns, or: true, not: true, num_args: 3);
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

  public function onNull(string|Stringable $column): static
  {
    return $this->on($column, "IS", new Raw("NULL"), num_args: 3);
  }

  public function orOnNull(string|Stringable $column): static
  {
    return $this->on($column, "IS", new Raw("NULL"), or: true, num_args: 3);
  }

  public function onNotNull(string|Stringable $column): static
  {
    return $this->on($column, "IS", new Raw("NULL"), not: true, num_args: 3);
  }

  public function orOnNotNull(string|Stringable $column): static
  {
    return $this->on($column, "IS", new Raw("NULL"), or: true, not: true, num_args: 3);
  }

}