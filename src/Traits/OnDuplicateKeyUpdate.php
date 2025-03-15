<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Raw;
use Stringable;

trait OnDuplicateKeyUpdate
{

  protected array $on_duplicate_key_update = [];

  public function onDuplicateKeyUpdate(
    string|array $column,
    string|Stringable|int|float|bool|null|array $value = null
  ): static
  {

    if (is_array($column) && 1 === func_num_args())
    {
      return $this->onDuplicateKeyUpdateArray($column);
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

    $this->on_duplicate_key_update[] = [$column, $this->sql->convert($value, bind_string: true)];

    return $this;

  }

  protected function onDuplicateKeyUpdateArray(array $columns): static
  {

    foreach ($columns as $column => $value)
    {
      $this->onDuplicateKeyUpdate($column, $value);
    }

    return $this;

  }

  public function onDuplicateKeyUpdateRaw(
    string|array $column,
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->onDuplicateKeyUpdate($column, new Raw($expression, $bindings));
  }

  protected function getOnDuplicateKeyUpdate(): string
  {

    if (empty($this->on_duplicate_key_update))
    {
      return "";
    }

    foreach ($this->on_duplicate_key_update as [$column, $value])
    {

      $v = is_array($value) ? "(" . implode(", ", $value) . ")" : $value;

      $on_duplicate_key_update[] = "$column = $v";

      $value = is_array($value) ? $value : [$value];

      foreach ($value as $part)
      {

        if ($part instanceof HasBindings)
        {
          $this->mergeBindings($part);
        }

      }

    }

    $on_duplicate_key_update = implode(", ", $on_duplicate_key_update);

    return "ON DUPLICATE KEY UPDATE $on_duplicate_key_update";

  }

}