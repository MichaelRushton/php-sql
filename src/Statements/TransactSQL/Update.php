<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\TransactSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update as StatementsUpdate;

class Update extends StatementsUpdate
{

  protected SQLInterface $sql = SQL::TransactSQL;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "UPDATE",
      $this->getTop(),
      $this->getTable(),
      $this->getSet(),
      $this->getOutput(),
      $this->getFrom(),
      $this->getJoin(),
      $this->getWhere(),
      $this->where_current_of,
    ];

  }

}