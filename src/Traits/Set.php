<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait Set
{

  protected array $set = [];

  public function set(
    string|array $column,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {

    if (is_array($column) && 1 === func_num_args())
    {
      return $this->setArray($column);
    }

    if (is_string($column))
    {
      $column = $this->sql->quote($column);
    }

    else
    {

      foreach ($column as &$c)
      {
        $c = $this->sql->quote($c);
      }

      $column = "(" . implode(", ", $column) . ")";

    }

    $this->set[] = [$column, $this->sql->convert($value, bind_string: true)];

    return $this;

  }

  protected function setArray(array $columns): static
  {

    foreach ($columns as $column => $value)
    {
      $this->set($column, $value);
    }

    return $this;

  }

  public function setRaw(
    string|array $column,
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->set($column, new Raw($expression, $bindings));
  }

  protected function getSet(): string
  {

    if (empty($this->set))
    {
      return "";
    }

    foreach ($this->set as [$column, $value])
    {

      $v = is_array($value) ? "(" . implode(", ", $value) . ")" : $value;

      $set[] = "$column = $v";

      $value = is_array($value) ? $value : [$value];

      foreach ($value as $part)
      {

        if ($part instanceof HasBindings)
        {
          $this->mergeBindings($part);
        }

      }

    }

    $set = implode(", ", $set);

    return "SET $set";

  }

}