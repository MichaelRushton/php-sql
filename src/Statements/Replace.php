<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Statements;

use MichaelRushton\SQL\Interfaces\Statements\ReplaceInterface;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statement;
use MichaelRushton\SQL\Traits\Columns;
use MichaelRushton\SQL\Traits\Delayed;
use MichaelRushton\SQL\Traits\Into;
use MichaelRushton\SQL\Traits\LowPriority;
use MichaelRushton\SQL\Traits\Returning;
use MichaelRushton\SQL\Traits\Select;
use MichaelRushton\SQL\Traits\Set;
use MichaelRushton\SQL\Traits\Values;
use MichaelRushton\SQL\Traits\With;

class Replace extends Statement implements ReplaceInterface
{
    use Columns;
    use Delayed;
    use Into;
    use LowPriority;
    use Returning;
    use Select;
    use Set;
    use Values;
    use With;

    protected function toArray(): array
    {

        return match ($this->sql()) {

            SQL::MariaDB => [
              "INSERT",
              $this->low_priority,
              $this->delayed,
              $this->into,
              $this->getColumns(),
              implode(" ", array_filter([
                $this->getValues(),
                $this->getSet(),
                $this->getSelect(),
              ], "strlen")) ?: "VALUES ()",
              $this->getReturning(),
            ],

            SQL::MySQL => [
              "INSERT",
              $this->low_priority,
              $this->into,
              $this->getColumns(),
              implode(" ", array_filter([
                $this->getValues(),
                $this->getSet(),
                $this->getSelect(),
              ], "strlen")) ?: "VALUES ()",
            ],

            SQL::SQLite => [
              $this->getWith(),
              "INSERT",
              $this->into,
              $this->getColumns(),
              implode(" ", array_filter([
                $this->getValues(),
                $this->getSelect(),
              ], "strlen")) ?: "DEFAULT VALUES",
              $this->getReturning(),
            ],

        };

    }

}
