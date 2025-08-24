<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Contracts\Traits\HasBindings;
use Stringable;

trait Returning
{
    protected array $returning = [];

    public function returning(string|Stringable|int|float|array $columns = "*"): static
    {

        $columns = is_array($columns) ? $columns : [$columns];

        foreach ($columns as $column) {
            $this->returning[] = $column;
        }

        return $this;

    }

    protected function getReturning(): string
    {

        if (empty($this->returning)) {
            return "";
        }

        $returning = implode(", ", $this->returning);

        foreach ($this->returning as $column) {

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return "RETURNING $returning";

    }

}
