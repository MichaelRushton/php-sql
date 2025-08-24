<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\SQL;
use Stringable;

trait SelectColumns
{
    protected array $columns = [];

    public function columns(string|Stringable|int|float|array $columns): static
    {

        $columns = is_array($columns) ? $columns : [$columns];

        foreach ($columns as $alias => $column) {
            $this->columns[] = [SQL::identifier($column), is_string($alias) ? " $alias" : ""];
        }

        return $this;

    }

    protected function getColumns(): string
    {

        if (empty($this->columns)) {
            return "*";
        }

        foreach ($this->columns as [$column, $alias]) {

            $columns[] = "$column$alias";

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return implode(", ", $columns);

    }

}
