<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services\MySQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\Table as ServicesTable;
use MichaelRushton\SQL\SQL;

class Table extends ServicesTable
{

  protected SQLInterface $sql = SQL::MySQL;

  protected function toArray(): array
  {

    return [
      $this->name,
      $this->getPartition(),
      $this->alias,
      $this->getIndexHint(),
    ];

  }

}