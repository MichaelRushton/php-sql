<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\PostgreSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete as StatementsDelete;

class Delete extends StatementsDelete
{

  protected SQLInterface $sql = SQL::PostgreSQL;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "DELETE",
      $this->getFrom(),
      $this->getUsing(),
      $this->getJoin(),
      $this->getWhere(),
      $this->where_current_of,
      $this->getReturning(),
    ];

  }

}