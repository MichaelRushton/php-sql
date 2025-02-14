<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\SQLite;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Replace as StatementsReplace;

class Replace extends StatementsReplace
{

  protected SQLInterface $sql = SQL::SQLite;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "REPLACE",
      $this->into,
      $this->getColumns(),
      implode(" ", array_filter([
        $this->getValues(),
        $this->getSelect(),
      ], "strlen")) ?: "DEFAULT VALUES",
      $this->getReturning(),
    ];

  }

}