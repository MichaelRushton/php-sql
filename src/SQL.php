<?php

declare(strict_types=1);

namespace MichaelRushton\SQL;

use BadMethodCallException;
use Closure;
use MichaelRushton\SQL\Contracts\CanConvertToSubquery;
use MichaelRushton\SQL\Contracts\HasAlias;
use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Services\CTE;
use MichaelRushton\SQL\Services\Expression;
use MichaelRushton\SQL\Services\MariaDB\CTE as MariaDBCTE;
use MichaelRushton\SQL\Services\MariaDB\Subquery as MariaDBSubquery;
use MichaelRushton\SQL\Services\MariaDB\Table as MariaDBTable;
use MichaelRushton\SQL\Services\MySQL\CTE as MySQLCTE;
use MichaelRushton\SQL\Services\MySQL\Subquery as MySQLSubquery;
use MichaelRushton\SQL\Services\MySQL\Table as MySQLTable;
use MichaelRushton\SQL\Services\PostgreSQL\CTE as PostgreSQLCTE;
use MichaelRushton\SQL\Services\PostgreSQL\Subquery as PostgreSQLSubquery;
use MichaelRushton\SQL\Services\PostgreSQL\Table as PostgreSQLTable;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\SQLite\CTE as SQLiteCTE;
use MichaelRushton\SQL\Services\SQLite\Subquery as SQLiteSubquery;
use MichaelRushton\SQL\Services\SQLite\Table as SQLiteTable;
use MichaelRushton\SQL\Services\Subquery;
use MichaelRushton\SQL\Services\Table;
use MichaelRushton\SQL\Services\TransactSQL\CTE as TransactSQLCTE;
use MichaelRushton\SQL\Services\TransactSQL\Subquery as TransactSQLSubquery;
use MichaelRushton\SQL\Services\TransactSQL\Table as TransactSQLTable;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\MariaDB\Delete as MariaDBDelete;
use MichaelRushton\SQL\Statements\MariaDB\Insert as MariaDBInsert;
use MichaelRushton\SQL\Statements\MariaDB\Replace as MariaDBReplace;
use MichaelRushton\SQL\Statements\MariaDB\Select as MariaDBSelect;
use MichaelRushton\SQL\Statements\MariaDB\Update as MariaDBUpdate;
use MichaelRushton\SQL\Statements\MySQL\Delete as MySQLDelete;
use MichaelRushton\SQL\Statements\MySQL\Insert as MySQLInsert;
use MichaelRushton\SQL\Statements\MySQL\Replace as MySQLReplace;
use MichaelRushton\SQL\Statements\MySQL\Select as MySQLSelect;
use MichaelRushton\SQL\Statements\MySQL\Update as MySQLUpdate;
use MichaelRushton\SQL\Statements\PostgreSQL\Delete as PostgreSQLDelete;
use MichaelRushton\SQL\Statements\PostgreSQL\Insert as PostgreSQLInsert;
use MichaelRushton\SQL\Statements\PostgreSQL\Select as PostgreSQLSelect;
use MichaelRushton\SQL\Statements\PostgreSQL\Update as PostgreSQLUpdate;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\SQLite\Delete as SQLiteDelete;
use MichaelRushton\SQL\Statements\SQLite\Insert as SQLiteInsert;
use MichaelRushton\SQL\Statements\SQLite\Replace as SQLiteReplace;
use MichaelRushton\SQL\Statements\SQLite\Select as SQLiteSelect;
use MichaelRushton\SQL\Statements\SQLite\Update as SQLiteUpdate;
use MichaelRushton\SQL\Statements\TransactSQL\Delete as TransactSQLDelete;
use MichaelRushton\SQL\Statements\TransactSQL\Insert as TransactSQLInsert;
use MichaelRushton\SQL\Statements\TransactSQL\Select as TransactSQLSelect;
use MichaelRushton\SQL\Statements\TransactSQL\Update as TransactSQLUpdate;
use MichaelRushton\SQL\Statements\Update;
use Stringable;

enum SQL implements SQLInterface
{

  case MariaDB;
  case MySQL;
  case PostgreSQL;
  case SQLite;
  case TransactSQL;

  public function delete(string|Stringable|array|null $from = null): Delete
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBDelete,
      static::MySQL => new MySQLDelete,
      static::PostgreSQL => new PostgreSQLDelete,
      static::SQLite => new SQLiteDelete,
      static::TransactSQL => new TransactSQLDelete,
    };

    return is_null($from) ? $stmt : $stmt->from($from);

  }

  public function insert(?array $values = null): Insert
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBInsert,
      static::MySQL => new MySQLInsert,
      static::PostgreSQL => new PostgreSQLInsert,
      static::SQLite => new SQLiteInsert,
      static::TransactSQL => new TransactSQLInsert,
    };

    return is_null($values) ? $stmt : $stmt->values($values);

  }

  public function replace(?array $values = null): Replace
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBReplace,
      static::MySQL => new MySQLReplace,
      static::SQLite => new SQLiteReplace,
      default => throw new BadMethodCallException,
    };

    return is_null($values) ? $stmt : $stmt->values($values);

  }

  public function select(string|Stringable|int|float|bool|null|array $column = null): Select
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBSelect,
      static::MySQL => new MySQLSelect,
      static::PostgreSQL => new PostgreSQLSelect,
      static::SQLite => new SQLiteSelect,
      static::TransactSQL => new TransactSQLSelect,
    };

    return func_num_args() ? $stmt->select($column) : $stmt;

  }

  public function update(string|Stringable|array|null $table = null): Update
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBUpdate,
      static::MySQL => new MySQLUpdate,
      static::PostgreSQL => new PostgreSQLUpdate,
      static::SQLite => new SQLiteUpdate,
      static::TransactSQL => new TransactSQLUpdate,
    };

    return is_null($table) ? $stmt : $stmt->table($table);

  }

  public function cte(
    string $name,
    string|Stringable|Closure $stmt
  ): CTE
  {

    return match ($this)
    {
      static::MariaDB => new MariaDBCTE($name, $stmt),
      static::MySQL => new MySQLCTE($name, $stmt),
      static::PostgreSQL => new PostgreSQLCTE($name, $stmt),
      static::SQLite => new SQLiteCTE($name, $stmt),
      static::TransactSQL => new TransactSQLCTE($name, $stmt),
    };

  }

  public function subquery(string|Stringable|Closure $stmt): Subquery
  {

    return match ($this)
    {
      static::MariaDB => new MariaDBSubquery($stmt),
      static::MySQL => new MySQLSubquery($stmt),
      static::PostgreSQL => new PostgreSQLSubquery($stmt),
      static::SQLite => new SQLiteSubquery($stmt),
      static::TransactSQL => new TransactSQLSubquery($stmt),
    };

  }

  public function table(string $name): Table
  {

    return match ($this)
    {
      static::MariaDB => new MariaDBTable($name),
      static::MySQL => new MySQLTable($name),
      static::PostgreSQL => new PostgreSQLTable($name),
      static::SQLite => new SQLiteTable($name),
      static::TransactSQL => new TransactSQLTable($name),
    };

  }

  public static function bind(string|int|float|bool $value): Raw
  {
    return new Raw("?", $value);
  }

  public function convert(
    string|Stringable|int|float|bool|null|array $expression,
    bool $bind_string = false
  ): string|Stringable|int|float|array
  {

    return match (true)
    {
      is_string($expression) && !$bind_string => $this->quote($expression),
      is_null($expression) => "NULL",
      is_array($expression) => array_map(fn ($exp) => $this->convert($exp, $bind_string), $expression),
      $expression instanceof CanConvertToSubquery => $expression->toSubquery(),
      $expression instanceof Stringable => $expression,
      default => new Raw("?", $expression),
    };

  }

  public function quote(string $identifier): string|array
  {

    $identifier = match ($this)
    {
      static::MariaDB, static::MySQL => "`" . str_replace("`", "``", $identifier) . "`",
      static::TransactSQL => "[" . str_replace("]", "]]", $identifier) . "]",
      default => '"' . str_replace('"', '""', $identifier) . '"',
    };

    $identifier = match ($this)
    {
      static::MariaDB, static::MySQL => str_replace(".", "`.`", $identifier),
      static::TransactSQL => str_replace(".", "].[", $identifier),
      default => str_replace(".", '"."', $identifier),
    };

    return match ($this)
    {
      static::MariaDB, static::MySQL => str_replace("`*`", "*", $identifier),
      static::TransactSQL => str_replace("[*]", "*", $identifier),
      default => str_replace('"*"', "*", $identifier),
    };

  }

  public function toTable(
    string|Stringable $table,
    string|int|null $alias = null
  ): Stringable
  {

    $table = match (true)
    {
      is_string($table) => $this->table($table),
      $table instanceof CanConvertToSubquery => $table->toSubquery(),
      $table instanceof HasAlias => $table,
      default => new Expression($this, $table),
    };

    if (is_string($alias))
    {
      $table->as($alias);
    }

    return $table;

  }

  public static function escape(string $string): string
  {
    return str_replace("'", "''", $string);
  }

}