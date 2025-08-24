<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use MichaelRushton\SQL\SQL;
use Stringable;

trait OrderBy
{
    protected array $order_by = [];

    public function orderBy(
        string|Stringable|array $column,
        string $direction = ""
    ): static {

        $columns = is_array($column) ? $column : [$column];

        foreach ($columns as $column) {
            $this->order_by[] = [SQL::identifier($column), $direction];
        }

        return $this;

    }

    public function orderByDesc(string|Stringable|array $column): static
    {
        return $this->orderBy($column, "DESC");
    }

    public function orderByNullsFirst(string|Stringable|array $column): static
    {
        return $this->orderBy($column, "ASC NULLS FIRST");
    }

    public function orderByNullsLast(string|Stringable|array $column): static
    {
        return $this->orderBy($column, "ASC NULLS LAST");
    }

    public function orderByDescNullsFirst(string|Stringable|array $column): static
    {
        return $this->orderBy($column, "DESC NULLS FIRST");
    }

    public function orderByDescNullsLast(string|Stringable|array $column): static
    {
        return $this->orderBy($column, "DESC NULLS LAST");
    }

    protected function getOrderBy(): string
    {

        if (empty($this->order_by)) {
            return "";
        }

        foreach ($this->order_by as [$column, $direction]) {

            $order_by[] = trim("$column $direction");

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        $order_by = implode(", ", $order_by);

        return "ORDER BY $order_by";

    }

}
