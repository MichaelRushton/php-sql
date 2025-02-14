<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts;

use Closure;
use Stringable;

interface SQLInterface
{

  public function select(string|Stringable|int|float|bool|null|array $column = null): Stringable;

  public function cte(
    string $name,
    string|Stringable|Closure $stmt
  ): Stringable;

  public function subquery(string|Stringable|Closure $stmt): Stringable;

  public function convert(
    string|Stringable|int|float|bool|null|array $expression,
    bool $bind_string = false
  ): string|Stringable|int|float|array;

  public function quote(string $identifier): string|array;

  public function toTable(
    string|Stringable $table,
    string|int|null $alias = null
  ): Stringable;

}