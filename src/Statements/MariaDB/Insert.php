<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\MariaDB;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert as StatementsInsert;

class Insert extends StatementsInsert
{

  protected SQLInterface $sql = SQL::MariaDB;

  protected function toArray(): array
  {

    return [
      "INSERT",
      $this->low_priority,
      $this->delayed,
      $this->high_priority,
      $this->ignore,
      $this->into,
      $this->getColumns(),
      implode(" ", array_filter([
        $this->getValues(),
        $this->getSet(),
        $this->getSelect(),
      ], "strlen")) ?: "VALUES ()",
      $this->getOnDuplicateKeyUpdate(),
      $this->getReturning(),
    ];

  }

}