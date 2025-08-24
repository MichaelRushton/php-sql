<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use MichaelRushton\SQL\SQL;
use Stringable;

trait From
{
    protected array $from = [];

    public function from(string|Stringable|array $table): static
    {

        $tables = is_array($table) ? $table : [$table];

        foreach ($tables as $alias => $table) {
            $this->from[] = [SQL::identifier($table), is_string($alias) ? " $alias" : ""];
        }

        return $this;

    }

    protected function getFrom(): string
    {

        if (empty($this->from)) {
            return "";
        }

        foreach ($this->from as [$table, $alias]) {

            $from[] = "$table$alias";

            if ($table instanceof HasBindings) {
                $this->mergeBindings($table);
            }

        }

        $from = implode(", ", $from);

        return "FROM $from";

    }

}
