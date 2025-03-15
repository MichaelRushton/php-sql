<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\TransactSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert as StatementsInsert;

class Insert extends StatementsInsert
{

  protected SQLInterface $sql = SQL::TransactSQL;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "INSERT",
      $this->getTop(),
      $this->into,
      $this->getColumns(),
      $this->getOutput(),
      implode(" ", array_filter([
        $this->getValues(),
        $this->getSelect(),
      ], "strlen")) ?: "DEFAULT VALUES",
    ];

  }

}