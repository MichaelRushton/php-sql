<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\MySQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Replace as StatementsReplace;

class Replace extends StatementsReplace
{

  protected SQLInterface $sql = SQL::MySQL;

  protected function toArray(): array
  {

    return [
      "REPLACE",
      $this->low_priority,
      $this->into,
      $this->getColumns(),
      implode(" ", array_filter([
        $this->getValues(),
        $this->getSet(),
        $this->getSelect(),
      ], "strlen")) ?: "VALUES ()",
    ];

  }

}