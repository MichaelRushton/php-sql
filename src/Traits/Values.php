<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\SQL;

trait Values
{

  protected array $values = [];

  public function values(array $values): static
  {

    if (empty($values))
    {
      return $this;
    }

    $values = is_array(current($values)) ? $values : [$values];

    foreach ($values as $row)
    {
      $this->values[] = SQL::value($row);
    }

    return $this;

  }

  protected function getValues(): string
  {

    if (empty($this->values))
    {
      return "";
    }

    foreach ($this->values as $row)
    {

      $values[] = implode(", ", $row);

      foreach ($row as $value)
      {

        if ($value instanceof HasBindings)
        {
          $this->mergeBindings($value);
        }

      }

    }

    $values = implode("), (", $values);

    return "VALUES ($values)";

  }

}