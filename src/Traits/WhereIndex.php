<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Traits;

use Closure;
use MichaelRushton\SQL\Components\Predicate;
use MichaelRushton\SQL\Components\Where;
use MichaelRushton\SQL\Interfaces\Traits\HasBindings;
use Stringable;

trait WhereIndex
{
    protected array $where_index = [];

    public function whereIndex(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static {

        if (is_array($column)) {
            return $this->whereIndexArray($column);
        }

        if ($column instanceof Closure) {
            $column->call($where = new Where(), $where);
        } else {
            $where = new Predicate($column, $operator, $value, func_num_args());
        }

        $this->where_index[] = $where;

        return $this;

    }

    protected function whereIndexArray(array $expressions): static
    {

        foreach ($expressions as $key => $expression) {
            $this->whereIndex($key, $expression);
        }

        return $this;

    }

    protected function getWhereIndex(): string
    {

        if (empty($this->where_index)) {
            return "";
        }

        $where_index = implode(" AND ", $this->where_index);

        foreach ($this->where_index as $expression) {

            if ($expression instanceof HasBindings) {
                $this->mergeBindings($expression);
            }

        }

        return "WHERE $where_index";

    }

}
