<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\HasAlias;
use MichaelRushton\SQL\Contracts\HasBindings;
use MichaelRushton\SQL\Services\Expression;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use Stringable;

trait Output
{

  protected array $output = [];

  public function output(string|Stringable|int|float|bool|null|array $column = "*"): static
  {

    $columns = is_array($column) ? $column : [$column];

    foreach ($columns as $alias => $column)
    {

      if (is_string($column = $this->sql->convert($column)) && "NULL" !== $column)
      {

        $column = preg_replace("/^\[(DELETED|INSERTED)\]/i", "$1", $column);

        if ($this instanceof Delete && 0 !== stripos($column, "DELETED"))
        {
          $column = "DELETED.$column";
        }

        elseif ($this instanceof Insert && 0 !== stripos($column, "INSERTED"))
        {
          $column = "INSERTED.$column";
        }

      }

      if (is_string($alias))
      {

        if (!($column instanceof HasAlias))
        {
          $column = new Expression($this->sql, $column);
        }

        $column->as($alias);

      }

      $this->output[] = $column;

    }

    return $this;

  }

  public function outputRaw(
    string $expression,
    string|int|float|bool|array $bindings = []
  ): static
  {
    return $this->output(new Raw($expression, $bindings));
  }

  protected function getOutput(): string
  {

    if (empty($this->output))
    {
      return "";
    }

    $output = implode(", ", $this->output);

    foreach ($this->output as $column)
    {

      if ($column instanceof HasBindings)
      {
        $this->mergeBindings($column);
      }

    }

    return "OUTPUT $output";

  }

}