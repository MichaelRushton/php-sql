<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Statements;

use Closure;
use MichaelRushton\SQL\Contracts\StatementInterface;
use Stringable;

interface InsertInterface extends StatementInterface
{

  public function with(
    string $name,
    string|Stringable|Closure $stmt,
    ?Closure $callback = null,
  ): static;

  public function recursive(): static;

  public function lowPriority(): static;

  public function delayed(): static;

  public function highPriority(): static;

  public function ignore(): static;

  public function orFail(): static;

  public function orIgnore(): static;

  public function orReplace(): static;

  public function orRollBack(): static;

  public function top(int|float|string|Stringable $row_count): static;

  public function percent(): static;

  public function into(string|Stringable $table): static;

  public function columns(string|array $columns): static;

  public function overridingSystemValue(): static;

  public function overridingUserValue(): static;

  public function output(string|Stringable|int|float|array $columns): static;

  public function values(array $values): static;

  public function set(
    string|array $column,
    string|Stringable|int|float|bool|null $value = null
  ): static;

  public function select(string|Stringable|Closure $stmt): static;

  public function as(
    string $row_alias,
    string|array|null $column_aliases = null
  ): static;

  public function onDuplicateKeyUpdate(
    string|array $column,
    string|Stringable|int|float|bool|null $value = null
  ): static;

  public function onConflictDoNothing(?Closure $callback = null): static;

  public function onConflictDoUpdateSet(
    string|array $column,
    string|Stringable|int|float|bool|null|Closure $value = null,
    ?Closure $callback = null
  ): static;

  public function returning(string|Stringable|int|float|array $columns = "*"): static;

}