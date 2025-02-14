<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services\TransactSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\Table as ServicesTable;
use MichaelRushton\SQL\SQL;

class Table extends ServicesTable
{

  protected SQLInterface $sql = SQL::TransactSQL;

  protected function toArray(): array
  {

    return [
      $this->name,
      $this->alias,
    ];

  }

}