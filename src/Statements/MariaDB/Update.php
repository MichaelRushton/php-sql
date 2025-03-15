<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\MariaDB;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update as StatementsUpdate;

class Update extends StatementsUpdate
{

  protected SQLInterface $sql = SQL::MariaDB;

  protected function toArray(): array
  {

    return [
      "UPDATE",
      $this->low_priority,
      $this->ignore,
      $this->getTable(),
      $this->getJoin(),
      $this->getSet(),
      $this->getWhere(),
      $this->getOrderBy(),
      $this->getLimit(),
    ];

  }

}