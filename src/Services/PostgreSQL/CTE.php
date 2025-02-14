<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Services\PostgreSQL;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\CTE as ServicesCTE;
use MichaelRushton\SQL\SQL;

class CTE extends ServicesCTE
{

  protected SQLInterface $sql = SQL::PostgreSQL;

  protected function toArray(): array
  {

    return [
      $this->name,
      $this->getColumns(),
      "AS",
      $this->materialized,
      $this->getStmt(),
      $this->search,
      $this->cycle,
    ];

  }

}