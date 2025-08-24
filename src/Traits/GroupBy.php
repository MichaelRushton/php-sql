<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use MichaelRushton\SQL\SQL;
use Stringable;

trait GroupBy
{
    protected array $group_by = [];
    protected string $with_rollup = "";

    public function groupBy(string|Stringable|array $column): static
    {

        $columns = is_array($column) ? $column : [$column];

        foreach ($columns as $column) {
            $this->group_by[] = SQL::identifier($column);
        }

        return $this;

    }

    public function withRollup(): static
    {

        $this->with_rollup = " WITH ROLLUP";

        return $this;

    }

    protected function getGroupBy(): string
    {

        if (empty($this->group_by)) {
            return "";
        }

        $group_by = implode(", ", $this->group_by);

        foreach ($this->group_by as $column) {

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return "GROUP BY $group_by$this->with_rollup";

    }

}
