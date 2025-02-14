<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Predicate;
use MichaelRushton\SQL\Services\Where;
use Stringable;

trait WhereIndex
{

  protected array $where_index = [];

  public function whereIndex(
    string|Stringable|int|float|bool|null|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {

    if (is_array($column) && 1 === func_num_args())
    {
      return $this->whereIndexArray($column);
    }

    if ($column instanceof Closure)
    {
      $column($where = new Where($this->sql));
    }

    else
    {
      $where = new Predicate($this->sql, $column, $operator, $value, func_num_args() + 1);
    }

    $this->where_index[] = $where;

    return $this;

  }

  protected function whereIndexArray(array $expressions): static
  {

    foreach ($expressions as $key => $expression)
    {
      $this->whereIndex($key, $expression);
    }

    return $this;

  }

  protected function getWhereIndex(): string
  {

    if (empty($this->where_index))
    {
      return "";
    }

    $where_index = implode(" AND ", $this->where_index);

    foreach ($this->where_index as $expression)
    {

      if ($expression instanceof HasBindings)
      {
        $this->mergeBindings($expression);
      }

    }

    return "WHERE $where_index";

  }

}