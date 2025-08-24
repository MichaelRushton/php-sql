<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Statements;

use Closure;
use MichaelRushton\SQL\Contracts\StatementInterface;
use Stringable;

interface UpdateInterface extends StatementInterface
{
    public function with(
        string $name,
        string|Stringable|Closure $stmt,
        ?Closure $callback = null,
    ): static;

    public function recursive(): static;

    public function lowPriority(): static;

    public function ignore(): static;

    public function orFail(): static;

    public function orIgnore(): static;

    public function orReplace(): static;

    public function orRollBack(): static;

    public function top(int|float|string|Stringable $row_count): static;

    public function percent(): static;

    public function table(string|Stringable|array $table): static;

    public function join(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static;

    public function leftJoin(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static;

    public function rightJoin(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static;

    public function fullJoin(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static;

    public function straightJoin(
        string|Stringable|array $table,
        string|Stringable|int|float|bool|null|array|Closure $column1 = null,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column2 = null
    ): static;

    public function crossJoin(string|Stringable|array $table): static;

    public function naturalJoin(string|Stringable|array $table): static;

    public function naturalLeftJoin(string|Stringable|array $table): static;

    public function naturalRightJoin(string|Stringable|array $table): static;

    public function naturalFullJoin(string|Stringable|array $table): static;

    public function set(
        string|array $column,
        string|Stringable|int|float|bool|null $value = null
    ): static;

    public function output(string|Stringable|int|float|array $columns): static;

    public function from(string|Stringable|array $table): static;

    public function where(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static;

    public function orWhere(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static;

    public function whereNot(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static;

    public function orWhereNot(
        string|Stringable|int|float|bool|array|Closure $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static;

    public function whereIn(
        string|Stringable|int|float|bool $column,
        array $values
    ): static;

    public function orWhereIn(
        string|Stringable|int|float|bool $column,
        array $values
    ): static;

    public function whereNotIn(
        string|Stringable|int|float|bool $column,
        array $values
    ): static;

    public function orWhereNotIn(
        string|Stringable|int|float|bool $column,
        array $values
    ): static;

    public function whereBetween(
        string|Stringable|int|float $column,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static;

    public function orWhereBetween(
        string|Stringable|int|float $column,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static;

    public function whereNotBetween(
        string|Stringable|int|float $column,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static;

    public function orWhereNotBetween(
        string|Stringable|int|float $column,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static;

    public function whereNull(string|Stringable $column): static;

    public function orWhereNull(string|Stringable $column): static;

    public function whereNotNull(string|Stringable $column): static;

    public function orWhereNotNull(string|Stringable $column): static;

    public function whereCurrentOf(string $cursor): static;

    public function returning(string|Stringable|int|float|array $columns = "*"): static;

    public function orderBy(string|Stringable|array $column): static;

    public function orderByDesc(string|Stringable|array $column): static;

    public function orderByNullsFirst(string|Stringable|array $column): static;

    public function orderByNullsLast(string|Stringable|array $column): static;

    public function orderByDescNullsFirst(string|Stringable|array $column): static;

    public function orderByDescNullsLast(string|Stringable|array $column): static;

    public function limit(int|string|Stringable $row_count): static;

}
