<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\TransactSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete as StatementsDelete;

class Delete extends StatementsDelete
{

  protected SQLInterface $sql = SQL::TransactSQL;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "DELETE",
      $this->getTop(),
      $this->getTable(),
      $this->getOutput(),
      $this->getFrom(),
      $this->getJoin(),
      $this->getWhere(),
      $this->where_current_of,
    ];

  }

}