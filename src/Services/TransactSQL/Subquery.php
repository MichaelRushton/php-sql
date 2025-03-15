<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services\TransactSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\Subquery as ServicesSubquery;
use MichaelRushton\SQL\SQL;

class Subquery extends ServicesSubquery
{

  protected SQLInterface $sql = SQL::TransactSQL;

  protected function toArray(): array
  {

    return [
      $this->all,
      $this->any,
      $this->exists,
      $this->in,
      $this->getStmt(),
      $this->alias,
      $this->getColumns(),
    ];

  }

}