<?php

declare(strict_types=1);

namespace MichaelRushton\SQL\Contracts;

use Closure;
use MichaelRushton\SQL\Services\CTE;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\Subquery;
use MichaelRushton\SQL\Services\Table;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\Update;
use Stringable;

interface SQLInterface
{

  public function delete(string|Stringable|array|null $from = null): Delete;

  public function insert(?array $values = null): Insert;

  public function replace(?array $values = null): Replace;

  public function select(string|Stringable|int|float|bool|null|array $column = null): Select;

  public function update(string|Stringable|array|null $table = null): Update;

  public function cte(
    string $name,
    string|Stringable|Closure $stmt
  ): CTE;

  public function subquery(string|Stringable|Closure $stmt): Subquery;

  public function table(string $name): Table;

  public static function bind(string|int|float|bool $value): Raw;

  public function convert(
    string|Stringable|int|float|bool|null|array $expression,
    bool $bind_string = false
  ): string|Stringable|int|float|array;

  public function quote(string $identifier): string|array;

  public function toTable(
    string|Stringable $table,
    string|int|null $alias = null
  ): Stringable;

  public static function escape(string $string): string;

}