<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Interfaces\Statements\DeleteInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\From;
use MichaelRushton\SQL\Traits\Ignore;
use MichaelRushton\SQL\Traits\Join;
use MichaelRushton\SQL\Traits\Limit;
use MichaelRushton\SQL\Traits\LowPriority;
use MichaelRushton\SQL\Traits\OrderBy;
use MichaelRushton\SQL\Traits\Output;
use MichaelRushton\SQL\Traits\Quick;
use MichaelRushton\SQL\Traits\Returning;
use MichaelRushton\SQL\Traits\Table;
use MichaelRushton\SQL\Traits\Top;
use MichaelRushton\SQL\Traits\Using;
use MichaelRushton\SQL\Traits\Where;
use MichaelRushton\SQL\Traits\WhereCurrentOf;
use MichaelRushton\SQL\Traits\With;

class Delete extends Statement implements DeleteInterface
{
    use From;
    use Ignore;
    use Join;
    use Limit;
    use LowPriority;
    use OrderBy;
    use Output;
    use Quick;
    use Returning;
    use Table;
    use Top;
    use Using;
    use Where;
    use WhereCurrentOf;
    use With;

    public function toArray(): array
    {

        return match ($this->sql()) {

            SQL::MariaDB => [
              "DELETE",
              $this->low_priority,
              $this->quick,
              $this->ignore,
              $this->getTable(),
              $this->getFrom(),
              $this->getUsing(),
              $this->getJoin(),
              $this->getWhere(),
              $this->getOrderBy(),
              $this->getLimit(),
              $this->getReturning(),
            ],

            SQL::MySQL => [
              $this->getWith(),
              "DELETE",
              $this->low_priority,
              $this->quick,
              $this->ignore,
              $this->getTable(),
              $this->getFrom(),
              $this->getUsing(),
              $this->getJoin(),
              $this->getWhere(),
              $this->getOrderBy(),
              $this->getLimit(),
            ],

            SQL::PostgreSQL => [
              $this->getWith(),
              "DELETE",
              $this->getFrom(),
              $this->getUsing(),
              $this->getJoin(),
              $this->getWhere(),
              $this->where_current_of,
              $this->getReturning(),
            ],

            SQL::SQLite => [
              $this->getWith(),
              "DELETE",
              $this->getFrom(),
              $this->getWhere(),
              $this->getReturning(),
              $this->getOrderBy(),
              $this->getLimit(),
            ],

            SQL::TransactSQL => [
              $this->getWith(),
              "DELETE",
              $this->getTop(),
              $this->getTable(),
              $this->getOutput(),
              $this->getFrom(),
              $this->getJoin(),
              $this->getWhere(),
              $this->where_current_of,
            ],

        };

    }

}
