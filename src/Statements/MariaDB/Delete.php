<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\MariaDB;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete as StatementsDelete;

class Delete extends StatementsDelete
{

  protected SQLInterface $sql = SQL::MariaDB;

  protected function toArray(): array
  {

    return [
      "DELETE",
      $this->low_priority,
      $this->quick,
      $this->ignore,
      $this->history,
      $this->getTable(),
      $this->getFrom(),
      $this->getUsing(),
      $this->getJoin(),
      $this->getWhere(),
      $this->getOrderBy(),
      $this->getLimit(),
      $this->getReturning(),
    ];

  }

}