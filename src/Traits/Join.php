<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Join as ServicesJoin;
use Stringable;

trait Join
{

  protected array $join = [];

  public function join(
    string|Stringable|array $table,
    string|Stringable|int|float|bool|null|array|Closure $column1 = null,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null,
    string $type = "JOIN",
    ?int $num_args = null
  ): static
  {

    $tables = is_array($table) ? $table : [$table];

    if (1 !== $num_args ??= func_num_args())
    {
      $condition = $this->joinCondition($column1, $operator, $column2, $num_args - 1);
    }

    foreach ($tables as $alias => $table)
    {
      $this->join[] = [$type, $this->sql->toTable($table, $alias), $condition ?? ""];
    }

    return $this;

  }

  public function leftJoin(
    string|Stringable|array $table,
    string|Stringable|int|float|bool|null|array|Closure $column1 = null,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null,
  ): static
  {
    return $this->join($table, $column1, $operator, $column2, "LEFT JOIN", func_num_args());
  }

  public function rightJoin(
    string|Stringable|array $table,
    string|Stringable|int|float|bool|null|array|Closure $column1 = null,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null,
  ): static
  {
    return $this->join($table, $column1, $operator, $column2, "RIGHT JOIN", func_num_args());
  }

  public function fullJoin(
    string|Stringable|array $table,
    string|Stringable|int|float|bool|null|array|Closure $column1 = null,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null,
  ): static
  {
    return $this->join($table, $column1, $operator, $column2, "FULL JOIN", func_num_args());
  }

  public function straightJoin(
    string|Stringable|array $table,
    string|Stringable|int|float|bool|null|array|Closure $column1 = null,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null,
  ): static
  {
    return $this->join($table, $column1, $operator, $column2, "STRAIGHT_JOIN", func_num_args());
  }

  public function crossJoin(string|Stringable|array $table): static
  {
    return $this->join($table, type: "CROSS JOIN", num_args: 1);
  }

  public function naturalJoin(string|Stringable|array $table): static
  {
    return $this->join($table, type: "NATURAL JOIN", num_args: 1);
  }

  public function naturalLeftJoin(string|Stringable|array $table): static
  {
    return $this->join($table, type: "NATURAL LEFT JOIN", num_args: 1);
  }

  public function naturalRightJoin(string|Stringable|array $table): static
  {
    return $this->join($table, type: "NATURAL RIGHT JOIN", num_args: 1);
  }

  public function naturalFullJoin(string|Stringable|array $table): static
  {
    return $this->join($table, type: "NATURAL FULL JOIN", num_args: 1);
  }

  protected function joinCondition(
    string|Stringable|int|float|bool|null|array|Closure $column1 = null,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $column2 = null,
    ?int $num_args = null
  ): array
  {

    if (
      1 === $num_args
      &&
      (
        is_string($column1)
        ||
        (is_array($column1) && !is_string(key($column1)))
      )
    )
    {
      return $this->joinUsing($column1);
    }

    $condition = (new ServicesJoin($this->sql))->on($column1, $operator, $column2, num_args: $num_args);

    return ["ON", $condition];

  }

  protected function joinUsing(string|array $column): array
  {

    $columns = (array) $column;

    foreach ($columns as &$column)
    {
      $column = $this->sql->quote($column);
    }

    $columns = implode(", ", $columns);

    return ["USING", "($columns)"];

  }

  protected function getJoin(): string
  {

    if (empty($this->join))
    {
      return "";
    }

    foreach ($this->join as [$type, $table, [$prefix, $condition]])
    {

      $join[] = trim("$type $table $prefix $condition");

      foreach ([$table, $condition] as $part)
      {

        if ($part instanceof HasBindings)
        {
          $this->mergeBindings($part);
        }

      }

    }

    return implode(" ", $join);

  }

}