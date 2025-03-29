<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts\Statements;

use Closure;
use MichaelRushton\SQL\Contracts\StatementInterface;
use Stringable;

interface ReplaceInterface extends StatementInterface
{

  public function with(
    string $name,
    string|Stringable|Closure $stmt,
    ?Closure $callback = null,
  ): static;

  public function recursive(): static;

  public function lowPriority(): static;

  public function delayed(): static;

  public function into(string|Stringable $table): static;

  public function columns(string|array $columns): static;

  public function values(array $values): static;

  public function set(
    string|array $column,
    string|Stringable|int|float|bool|null $value = null
  ): static;

  public function select(string|Stringable|Closure $stmt): static;

  public function returning(string|Stringable|int|float|array $columns = "*"): static;

}