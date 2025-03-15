<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\SQLite;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update as StatementsUpdate;

class Update extends StatementsUpdate
{

  protected SQLInterface $sql = SQL::SQLite;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "UPDATE",
      $this->or,
      $this->getTable(),
      $this->getSet(),
      $this->getFrom(),
      $this->getJoin(),
      $this->getWhere(),
      $this->getReturning(),
      $this->getOrderBy(),
      $this->getLimit(),
    ];

  }

}