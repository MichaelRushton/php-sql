<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Contracts\Statements\UpdateInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\From;
use MichaelRushton\SQL\Traits\Ignore;
use MichaelRushton\SQL\Traits\Join;
use MichaelRushton\SQL\Traits\Limit;
use MichaelRushton\SQL\Traits\LowPriority;
use MichaelRushton\SQL\Traits\OrderBy;
use MichaelRushton\SQL\Traits\OrOnConflict;
use MichaelRushton\SQL\Traits\Output;
use MichaelRushton\SQL\Traits\Returning;
use MichaelRushton\SQL\Traits\Set;
use MichaelRushton\SQL\Traits\Table;
use MichaelRushton\SQL\Traits\Top;
use MichaelRushton\SQL\Traits\Where;
use MichaelRushton\SQL\Traits\WhereCurrentOf;
use MichaelRushton\SQL\Traits\With;

class Update extends Statement implements UpdateInterface
{

  use From;
  use Ignore;
  use Join;
  use Limit;
  use LowPriority;
  use OrderBy;
  use OrOnConflict;
  use Output;
  use Returning;
  use Set;
  use Table;
  use Top;
  use Where;
  use WhereCurrentOf;
  use With;

  protected function toArray(): array
  {

    return match ($this->sql())
    {

      SQL::MariaDB => [
        "UPDATE",
        $this->low_priority,
        $this->ignore,
        $this->getTable(),
        $this->getJoin(),
        $this->getSet(),
        $this->getWhere(),
        $this->getOrderBy(),
        $this->getLimit(),
      ],

      SQL::MySQL => [
        $this->getWith(),
        "UPDATE",
        $this->low_priority,
        $this->ignore,
        $this->getTable(),
        $this->getJoin(),
        $this->getSet(),
        $this->getWhere(),
        $this->getOrderBy(),
        $this->getLimit(),
      ],

      SQL::PostgreSQL => [
        $this->getWith(),
        "UPDATE",
        $this->getTable(),
        $this->getSet(),
        $this->getFrom(),
        $this->getJoin(),
        $this->getWhere(),
        $this->where_current_of,
        $this->getReturning(),
      ],

      SQL::SQLite => [
        $this->getWith(),
        "UPDATE",
        $this->or,
        $this->getTable(),
        $this->getSet(),
        $this->getFrom(),
        $this->getJoin(),
        $this->getWhere(),
        $this->getReturning(),
        $this->getOrderBy(),
        $this->getLimit(),
      ],

      SQL::TransactSQL => [
        $this->getWith(),
        "UPDATE",
        $this->getTop(),
        $this->getTable(),
        $this->getSet(),
        $this->getOutput(),
        $this->getFrom(),
        $this->getJoin(),
        $this->getWhere(),
        $this->where_current_of,
      ],

    };

  }

}