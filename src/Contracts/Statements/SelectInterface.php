<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Statements;

use Closure;
use MichaelRushton\SQL\Contracts\StatementInterface;
use Stringable;

interface SelectInterface extends StatementInterface
{

  public function with(
    string $name,
    string|Stringable|Closure $stmt,
    ?Closure $callback = null,
  ): static;

  public function recursive(): static;

  public function distinct(): static;

  public function highPriority(): static;

  public function straightJoinAll(): static;

  public function sqlSmallResult(): static;

  public function sqlBigResult(): static;

  public function sqlBufferResult(): static;

  public function sqlCache(): static;

  public function sqlNoCache(): static;

  public function sqlCalcFoundRows(): static;

  public function top(int|float|string|Stringable $row_count): static;

  public function percent(): static;

  public function columns(string|Stringable|int|float|array $columns): static;

  public function into(string|Stringable $table): static;

  public function from(string|Stringable|array $table): static;

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

  public function groupBy(string|Stringable|array $column): static;

  public function withRollup(): static;

  public function having(
    string|Stringable|int|float|bool|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static;

  public function orHaving(
    string|Stringable|int|float|bool|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static;

  public function havingNot(
    string|Stringable|int|float|bool|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static;

  public function orHavingNot(
    string|Stringable|int|float|bool|array|Closure $column,
    string|Stringable|int|float|bool|null|array $operator = null,
    string|Stringable|int|float|bool|null|array $value = null
  ): static;

  public function havingIn(
    string|Stringable|int|float|bool $column,
    array $values
  ): static;

  public function orHavingIn(
    string|Stringable|int|float|bool $column,
    array $values
  ): static;

  public function havingNotIn(
    string|Stringable|int|float|bool $column,
    array $values
  ): static;

  public function orHavingNotIn(
    string|Stringable|int|float|bool $column,
    array $values
  ): static;

  public function havingBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static;

  public function orHavingBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static;

  public function havingNotBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static;

  public function orHavingNotBetween(
    string|Stringable|int|float $column,
    string|Stringable|int|float $value1,
    string|Stringable|int|float $value2
  ): static;

  public function havingNull(string|Stringable $column): static;

  public function orHavingNull(string|Stringable $column): static;

  public function havingNotNull(string|Stringable $column): static;

  public function orHavingNotNull(string|Stringable $column): static;

  public function window(
    string $name,
    ?Closure $callback = null,
  ): static;

  public function union(string|Stringable|Closure|array $stmt): static;

  public function unionAll(string|Stringable|Closure|array $stmt): static;

  public function intersect(string|Stringable|Closure|array $stmt): static;

  public function intersectAll(string|Stringable|Closure|array $stmt): static;

  public function except(string|Stringable|Closure|array $stmt): static;

  public function exceptAll(string|Stringable|Closure|array $stmt): static;

  public function orderBy(string|Stringable|array $column): static;

  public function orderByDesc(string|Stringable|array $column): static;

  public function orderByNullsFirst(string|Stringable|array $column): static;

  public function orderByNullsLast(string|Stringable|array $column): static;

  public function orderByDescNullsFirst(string|Stringable|array $column): static;

  public function orderByDescNullsLast(string|Stringable|array $column): static;

  public function limit(
    int|string|Stringable $row_count,
    int|string|Stringable|null $offset = null
  ): static;

  public function offsetFetch(
    int|string|Stringable $offset,
    int|string|Stringable $row_count
  ): static;

  public function withTies(): static;

  public function rowsExamined(int|string|Stringable $row_count): static;

  public function intoOutfile(
    string $path,
    ?Closure $callback = null
  ): static;

  public function intoDumpfile(string $path): static;

  public function intoVar(string|array $name): static;

  public function forUpdate(string|array|null $table = null): static;

  public function forUpdateWait(int $seconds): static;

  public function forUpdateNoWait(string|array|null $table = null): static;

  public function forUpdateSkipLocked(string|array|null $table = null): static;

  public function forNoKeyUpdate(string|array|null $table = null): static;

  public function forNoKeyUpdateNoWait(string|array|null $table = null): static;

  public function forNoKeyUpdateSkipLocked(string|array|null $table = null): static;

  public function forShare(string|array|null $table = null): static;

  public function forShareNoWait(string|array|null $table = null): static;

  public function forShareSkipLocked(string|array|null $table = null): static;

  public function forKeyShare(string|array|null $table = null): static;

  public function forKeyShareNoWait(string|array|null $table = null): static;

  public function forKeyShareSkipLocked(string|array|null $table = null): static;

  public function lockInShareMode(): static;

  public function lockInShareModeWait(int $seconds): static;

  public function lockInShareModeNoWait(): static;

  public function lockInShareModeSkipLocked(): static;

}