<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\SQLite;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete as StatementsDelete;

class Delete extends StatementsDelete
{

  protected SQLInterface $sql = SQL::SQLite;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "DELETE",
      $this->getFrom(),
      $this->getWhere(),
      $this->getReturning(),
      $this->getOrderBy(),
      $this->getLimit(),
    ];

  }

}