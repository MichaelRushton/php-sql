<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Contracts\Statements\InsertInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\Delayed;
use MichaelRushton\SQL\Traits\HighPriority;
use MichaelRushton\SQL\Traits\Ignore;
use MichaelRushton\SQL\Traits\Into;
use MichaelRushton\SQL\Traits\LowPriority;
use MichaelRushton\SQL\Traits\OnConflict;
use MichaelRushton\SQL\Traits\OnDuplicateKeyUpdate;
use MichaelRushton\SQL\Traits\OrOnConflict;
use MichaelRushton\SQL\Traits\Output;
use MichaelRushton\SQL\Traits\Overriding;
use MichaelRushton\SQL\Traits\Returning;
use MichaelRushton\SQL\Traits\RowAlias;
use MichaelRushton\SQL\Traits\Select;
use MichaelRushton\SQL\Traits\Set;
use MichaelRushton\SQL\Traits\Top;
use MichaelRushton\SQL\Traits\Values;
use MichaelRushton\SQL\Traits\With;

class Insert extends Statement implements InsertInterface
{
    use Columns;
    use Delayed;
    use HighPriority;
    use Ignore;
    use Into;
    use LowPriority;
    use OnConflict;
    use OnDuplicateKeyUpdate;
    use OrOnConflict;
    use Output;
    use Overriding;
    use Returning;
    use RowAlias;
    use Select;
    use Set;
    use Top;
    use Values;
    use With;

    protected function toArray(): array
    {

        return match ($this->sql()) {

            SQL::MariaDB => [
              "INSERT",
              $this->low_priority,
              $this->delayed,
              $this->high_priority,
              $this->ignore,
              $this->into,
              $this->getColumns(),
              implode(" ", array_filter([
                $this->getValues(),
                $this->getSet(),
                $this->getSelect(),
              ], "strlen")) ?: "VALUES ()",
              $this->getOnDuplicateKeyUpdate(),
              $this->getReturning(),
            ],

            SQL::MySQL => [
              "INSERT",
              $this->low_priority,
              $this->high_priority,
              $this->ignore,
              $this->into,
              $this->getColumns(),
              implode(" ", array_filter([
                $this->getValues(),
                $this->getSet(),
                $this->getSelect(),
              ], "strlen")) ?: "VALUES ()",
              $this->row_alias,
              $this->getOnDuplicateKeyUpdate(),
            ],

            SQL::PostgreSQL => [
              $this->getWith(),
              "INSERT",
              $this->into,
              $this->getColumns(),
              $this->overriding,
              implode(" ", array_filter([
                $this->getValues(),
                $this->getSelect(),
              ], "strlen")) ?: "DEFAULT VALUES",
              $this->getOnConflict(),
              $this->getReturning(),
            ],

            SQL::SQLite => [
              $this->getWith(),
              "INSERT",
              $this->or,
              $this->into,
              $this->getColumns(),
              implode(" ", array_filter([
                $this->getValues(),
                $this->getSelect(),
              ], "strlen")) ?: "DEFAULT VALUES",
              $this->getOnConflict(),
              $this->getReturning(),
            ],

            SQL::TransactSQL => [
              $this->getWith(),
              "INSERT",
              $this->getTop(),
              $this->into,
              $this->getColumns(),
              $this->getOutput(),
              implode(" ", array_filter([
                $this->getValues(),
                $this->getSelect(),
              ], "strlen")) ?: "DEFAULT VALUES",
            ],

        };

    }

}
