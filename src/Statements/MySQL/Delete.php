<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\MySQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete as StatementsDelete;

class Delete extends StatementsDelete
{

  protected SQLInterface $sql = SQL::MySQL;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "DELETE",
      $this->low_priority,
      $this->quick,
      $this->ignore,
      $this->getTable(),
      $this->getFrom(),
      $this->getUsing(),
      $this->getJoin(),
      $this->getWhere(),
      $this->getOrderBy(),
      $this->getLimit(),
    ];

  }

}