<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\SQL;
use Stringable;

trait OnDuplicateKeyUpdate
{

  protected array $on_duplicate_key_update = [];

  public function onDuplicateKeyUpdate(
    string|array $column,
    string|Stringable|int|float|bool|null $value = null
  ): static
  {

    if (is_array($column))
    {
      return $this->onDuplicateKeyUpdateArray($column);
    }

    $this->on_duplicate_key_update[$column] = SQL::value($value);

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

  protected function getOnDuplicateKeyUpdate(): string
  {

    if (empty($this->on_duplicate_key_update))
    {
      return "";
    }

    foreach ($this->on_duplicate_key_update as $column => $value)
    {

      $on_duplicate_key_update[] = "$column = $value";

      if ($value instanceof HasBindings)
      {
        $this->mergeBindings($value);
      }

    }

    $on_duplicate_key_update = implode(", ", $on_duplicate_key_update);

    return "ON DUPLICATE KEY UPDATE $on_duplicate_key_update";

  }

}