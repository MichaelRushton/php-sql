<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

trait ForLockOf
{

  protected function getForLockOf(string|array|null $table): string
  {

    if (empty($table))
    {
      return "";
    }

    foreach ((array) $table as $t)
    {
      $tables[] = $t;
    }

    return "OF " . implode(", ", $tables);

  }

}