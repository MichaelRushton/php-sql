<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Components\Having as ComponentsHaving;
use MichaelRushton\SQL\Components\Predicate;
use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use Stringable;

trait Having
{
    protected array $having = [];

    public function having(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null,
        bool $or = false,
        bool $not = false,
        ?int $num_args = null
    ): static {

        if (is_array($column)) {
            return $this->havingArray($column, $or, $not);
        }

        if ($column instanceof Closure) {
            $column->call($having = new ComponentsHaving(), $having);
        } else {
            $having = new Predicate($column, $operator, $value, $num_args ??= func_num_args());
        }

        $conjunction = empty($this->having) ? "" : ($or ? "OR " : "AND ");

        $not = $not ? "NOT " : "";

        $this->having[] = ["$conjunction$not", $having];

        return $this;

    }

    protected function havingArray(
        array $expressions,
        bool $or,
        bool $not
    ): static {

        foreach ($expressions as $key => $expression) {
            $this->having($key, $expression, or: $or, not: $not, num_args: 2);
        }

        return $this;

    }

    public function orHaving(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static {
        return $this->having($column, $operator, $value, or: true, num_args: func_num_args());
    }

    public function havingNot(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static {
        return $this->having($column, $operator, $value, not: true, num_args: func_num_args());
    }

    public function orHavingNot(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static {
        return $this->having($column, $operator, $value, or: true, not: true, num_args: func_num_args());
    }

    public function havingIn(
        string|Stringable|int|float|bool $column,
        array $values
    ): static {
        return $this->having($column, "IN", $values);
    }

    public function orHavingIn(
        string|Stringable|int|float|bool $column,
        array $values
    ): static {
        return $this->having($column, "IN", $values, or: true, num_args: 3);
    }

    public function havingNotIn(
        string|Stringable|int|float|bool $column,
        array $values
    ): static {
        return $this->having($column, "IN", $values, not: true, num_args: 3);
    }

    public function orHavingNotIn(
        string|Stringable|int|float|bool $column,
        array $values
    ): static {
        return $this->having($column, "IN", $values, or: true, not: true, num_args: 3);
    }

    public function havingBetween(
        string|Stringable|int|float $column,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static {
        return $this->having($column, "BETWEEN", [$value1, $value2]);
    }

    public function orHavingBetween(
        string|Stringable|int|float $column,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static {
        return $this->having($column, "BETWEEN", [$value1, $value2], or: true, num_args: 3);
    }

    public function havingNotBetween(
        string|Stringable|int|float $column,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static {
        return $this->having($column, "BETWEEN", [$value1, $value2], not: true, num_args: 3);
    }

    public function orHavingNotBetween(
        string|Stringable|int|float $column,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static {
        return $this->having($column, "BETWEEN", [$value1, $value2], or: true, not: true, num_args: 3);
    }

    public function havingNull(string|Stringable $column): static
    {
        return $this->having($column, "IS", new Raw("NULL"), num_args: 3);
    }

    public function orHavingNull(string|Stringable $column): static
    {
        return $this->having($column, "IS", new Raw("NULL"), or: true, num_args: 3);
    }

    public function havingNotNull(string|Stringable $column): static
    {
        return $this->having($column, "IS", new Raw("NULL"), not: true, num_args: 3);
    }

    public function orHavingNotNull(string|Stringable $column): static
    {
        return $this->having($column, "IS", new Raw("NULL"), or: true, not: true, num_args: 3);
    }

    protected function getHaving(): string
    {

        if (empty($this->having)) {
            return "";
        }

        foreach ($this->having as [$prefix, $predicate]) {

            $having[] = "$prefix$predicate";

            if ($predicate instanceof HasBindings) {
                $this->mergeBindings($predicate);
            }

        }

        $having = implode(" ", $having);

        return "HAVING $having";

    }

}
