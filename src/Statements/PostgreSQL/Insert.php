<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\PostgreSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert as StatementsInsert;

class Insert extends StatementsInsert
{

  protected SQLInterface $sql = SQL::PostgreSQL;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "INSERT",
      $this->into,
      $this->getColumns(),
      $this->overriding,
      implode(" ", array_filter([
        $this->getValues(),
        $this->getSelect(),
      ], "strlen")) ?: "DEFAULT VALUES",
      $this->getOnConflict(),
      $this->getReturning(),
    ];

  }

}