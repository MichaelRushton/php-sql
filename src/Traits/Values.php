<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Exception;
use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\SQL;

trait Values
{

  protected array $values = [];

  use Columns;

  public function values(array $values): static
  {

    if (empty($values))
    {
      return $this;
    }

    $values = is_array(current($values)) ? $values : [$values];

    $this->setColumns($values);

    foreach ($values as $row)
    {
      $this->values[] = SQL::value($row);
    }

    return $this;

  }

  protected function setColumns(array &$values): void
  {

    if (!empty($this->columns))
    {
      return;
    }

    $columns = array_keys($values[0]);

    if (count($columns) !== count(array_filter($columns, "is_string")))
    {
      return;
    }

    $this->columns($columns);

    foreach ($values as &$row)
    {
      $row = array_merge($values[0], $row);
    }

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