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

        foreach ($tables as $table) {
            $this->from[] = SQL::identifier($table);
        }

        return $this;

    }

    protected function getFrom(): string
    {

        if (empty($this->from)) {
            return "";
        }

        $from = implode(", ", $this->from);

        foreach ($this->from as $table) {

            if ($table instanceof HasBindings) {
                $this->mergeBindings($table);
            }

        }

        return "FROM $from";

    }

}
