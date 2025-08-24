<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Components\On;
use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use MichaelRushton\SQL\SQL;
use Stringable;

trait Join
{
    protected array $join = [];

    public function join(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null,
        string $type = "JOIN",
        ?int $num_args = null
    ): static {

        $tables = is_array($table) ? $table : [$table];

        if (1 !== $num_args ??= func_num_args()) {
            $condition = $this->condition($column1, $operator, $column2, $num_args - 1);
        }

        foreach ($tables as $alias => $table) {

            $alias = is_string($alias) ? " $alias" : "";

            $this->join[] = [$type, SQL::identifier($table), $alias, $condition ?? ""];

        }

        return $this;

    }

    protected function condition(
        string|Stringable|int|float|bool|null|array|Closure $column1,
        string|Stringable|int|float|bool|null|array $operator,
        string|Stringable|int|float|bool|null|array $column2,
        int $num_args
    ): array {

        if (
            1 === $num_args
            &&
            (
                is_string($column1)
        ||
        (is_array($column1) && !is_string(key($column1)))
            )
        ) {

            $columns = implode(", ", (array) $column1);

            return ["USING", "($columns)"];

        }

        $condition = (new On())->on($column1, $operator, $column2, num_args: $num_args);

        return ["ON", $condition];

    }

    public function leftJoin(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static {
        return $this->join($table, $column1, $operator, $column2, "LEFT JOIN", func_num_args());
    }

    public function rightJoin(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static {
        return $this->join($table, $column1, $operator, $column2, "RIGHT JOIN", func_num_args());
    }

    public function fullJoin(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static {
        return $this->join($table, $column1, $operator, $column2, "FULL JOIN", func_num_args());
    }

    public function straightJoin(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static {
        return $this->join($table, $column1, $operator, $column2, "STRAIGHT_JOIN", func_num_args());
    }

    public function crossJoin(string|Stringable|array $table): static
    {
        return $this->join($table, type: "CROSS JOIN", num_args: 1);
    }

    public function naturalJoin(string|Stringable|array $table): static
    {
        return $this->join($table, type: "NATURAL JOIN", num_args: 1);
    }

    public function naturalLeftJoin(string|Stringable|array $table): static
    {
        return $this->join($table, type: "NATURAL LEFT JOIN", num_args: 1);
    }

    public function naturalRightJoin(string|Stringable|array $table): static
    {
        return $this->join($table, type: "NATURAL RIGHT JOIN", num_args: 1);
    }

    public function naturalFullJoin(string|Stringable|array $table): static
    {
        return $this->join($table, type: "NATURAL FULL JOIN", num_args: 1);
    }

    protected function getJoin(): string
    {

        if (empty($this->join)) {
            return "";
        }

        foreach ($this->join as [$type, $table, $alias, [$prefix, $condition]]) {

            $join[] = trim("$type $table$alias $prefix $condition");

            foreach ([$table, $condition] as $part) {

                if ($part instanceof HasBindings) {
                    $this->mergeBindings($part);
                }

            }

        }

        return implode(" ", $join);

    }

}
