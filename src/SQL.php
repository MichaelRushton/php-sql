<?php

declare(strict_types=1);

namespace MichaelRushton\SQL;

use BadMethodCallException;
use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Contracts\Statements\DeleteInterface;
use MichaelRushton\SQL\Contracts\Statements\InsertInterface;
use MichaelRushton\SQL\Contracts\Statements\ReplaceInterface;
use MichaelRushton\SQL\Contracts\Statements\SelectInterface;
use MichaelRushton\SQL\Contracts\Statements\UpdateInterface;
use MichaelRushton\SQL\Contracts\Traits\CanConvertToSubquery;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\Update;
use Stringable;

enum SQL implements SQLInterface
{

  case MariaDB;
  case MySQL;
  case PostgreSQL;
  case SQLite;
  case TransactSQL;

  public function delete(): DeleteInterface
  {
    return new Delete($this);
  }

  public function insert(): InsertInterface
  {
    return new Insert($this);
  }

  public function replace(): ReplaceInterface
  {

    if (!in_array($this, [static::MariaDB, static::MySQL, static:: SQLite]))
    {
      throw new BadMethodCallException;
    }

    return new Replace($this);

  }

  public function select(): SelectInterface
  {
    return new Select($this);
  }

  public function update(): UpdateInterface
  {
    return new Update($this);
  }

  public static function bind(string|int|float|bool|null $value): Raw
  {
    return new Raw("?", $value);
  }

  public static function identifier(
    string|Stringable|int|float|bool|null|array $column
  ): string|Stringable|int|float|array
  {

    return match (true)
    {
      is_array($column) => array_map(static::identifier(...), $column),
      is_bool($column ?? true) => new Raw("?", $column),
      $column instanceof CanConvertToSubquery => $column->toSubquery(),
      default => $column,
    };

  }

  public static function value(
    string|Stringable|int|float|bool|null|array $value
  ): string|Stringable|array
  {

    return match (true)
    {
      is_array($value) => array_map(static::value(...), $value),
      is_scalar($value ?? true) => new Raw("?", $value),
      $value instanceof CanConvertToSubquery => $value->toSubquery(),
      default => $value,
    };

  }

  public static function escape(string $string): string
  {
    return str_replace("'", "''", $string);
  }

}