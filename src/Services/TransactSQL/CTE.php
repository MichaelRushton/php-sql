<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services\TransactSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\CTE as ServicesCTE;
use MichaelRushton\SQL\SQL;

class CTE extends ServicesCTE
{

  protected SQLInterface $sql = SQL::TransactSQL;

  protected function toArray(): array
  {

    return [
      $this->name,
      $this->getColumns(),
      "AS",
      $this->getStmt(),
    ];

  }

}