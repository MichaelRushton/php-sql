<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait Cycle
{

  protected string $cycle = "";

  public function cycle(
    string|array $column,
    string $set = "is_cycle",
    string $using = "path"
  ): static
  {

    foreach ((array) $column as $c)
    {
      $columns[] = $this->sql->quote($c);
    }

    $columns = implode(", ", $columns);

    $set = $this->sql->quote($set);

    $this->cycle = "CYCLE $columns SET $set USING " . $this->sql->quote($using);

    return $this;

  }

}