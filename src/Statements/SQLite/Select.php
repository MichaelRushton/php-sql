<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements\SQLite;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select as StatementsSelect;

class Select extends StatementsSelect
{

  protected SQLInterface $sql = SQL::SQLite;

  protected function toArray(): array
  {

    return [
      $this->getWith(),
      "SELECT",
      $this->distinct,
      $this->getSelect(),
      $this->getFrom(),
      $this->getJoin(),
      $this->getWhere(),
      $this->getGroupBy(),
      $this->getHaving(),
      $this->getWindow(),
      $this->getSetOperation(),
      $this->getOrderBy(),
      $this->getLimit(),
    ];

  }

}