<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services\MariaDB;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\Table as ServicesTable;
use MichaelRushton\SQL\SQL;

class Table extends ServicesTable
{

  protected SQLInterface $sql = SQL::MariaDB;

  protected function toArray(): array
  {

    return [
      $this->name,
      $this->getPartition(),
      $this->for_system_time,
      $this->for_portion_of,
      $this->before_system_time,
      $this->alias,
      $this->getIndexHint(),
    ];

  }

}