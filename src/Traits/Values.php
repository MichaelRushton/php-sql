<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasBindings;

trait Values
{

  protected array $values = [];

  use Columns;

  public function values(array $values): static
  {

    $values = is_array(current($values)) ? $values : [$values];

    foreach ($values as $row)
    {

      if (empty($this->columns) && is_string(key($row)))
      {
        $this->columns(array_keys($row));
      }

      foreach ($row as &$value)
      {
        $value = $this->sql->convert($value, bind_string: true);
      }

      $this->values[] = $row;

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