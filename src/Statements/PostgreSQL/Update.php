<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\PostgreSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update as StatementsUpdate;

class Update extends StatementsUpdate
{

  protected SQLInterface $sql = SQL::PostgreSQL;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "UPDATE",
      $this->getTable(),
      $this->getSet(),
      $this->getFrom(),
      $this->getJoin(),
      $this->getWhere(),
      $this->where_current_of,
      $this->getReturning(),
    ];

  }

}