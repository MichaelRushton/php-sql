<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services\MySQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\CTE as ServicesCTE;
use MichaelRushton\SQL\SQL;

class CTE extends ServicesCTE
{

  protected SQLInterface $sql = SQL::MySQL;

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