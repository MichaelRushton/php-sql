<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services\SQLite;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\Subquery as ServicesSubquery;
use MichaelRushton\SQL\SQL;

class Subquery extends ServicesSubquery
{

  protected SQLInterface $sql = SQL::SQLite;

  protected function toArray(): array
  {

    return [
      $this->exists,
      $this->in,
      $this->getStmt(),
      $this->alias,
    ];

  }

}