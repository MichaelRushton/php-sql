<?php

declare(strict_types=1);

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
use MichaelRushton\SQL\SQL;
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
use MichaelRushton\SQL\Statements\SQLite\Delete as SQLiteDelete;
use MichaelRushton\SQL\Statements\SQLite\Insert as SQLiteInsert;
use MichaelRushton\SQL\Statements\SQLite\Replace as SQLiteReplace;
use MichaelRushton\SQL\Statements\SQLite\Select as SQLiteSelect;
use MichaelRushton\SQL\Statements\SQLite\Update as SQLiteUpdate;
use MichaelRushton\SQL\Statements\TransactSQL\Delete as TransactSQLDelete;
use MichaelRushton\SQL\Statements\TransactSQL\Insert as TransactSQLInsert;
use MichaelRushton\SQL\Statements\TransactSQL\Select as TransactSQLSelect;
use MichaelRushton\SQL\Statements\TransactSQL\Update as TransactSQLUpdate;

it("can delete", function (SQL $sql, $class)
{

  expect($stmt = $sql->delete("t1"))
  ->toBeInstanceOf($class);

  expect((string) $stmt)
  ->toBe("DELETE FROM " . $sql->quote("t1"));

})
->with([
  [SQL::MariaDB, MariaDBDelete::class],
  [SQL::MySQL, MySQLDelete::class],
  [SQL::PostgreSQL, PostgreSQLDelete::class],
  [SQL::SQLite, SQLiteDelete::class],
  [SQL::TransactSQL, TransactSQLDelete::class],
]);

it("can insert", function (SQL $sql, $class)
{

  expect($stmt = $sql->insert([1]))
  ->toBeInstanceOf($class);

  expect((string) $stmt)
  ->toBe("INSERT VALUES (1)");

})
->with([
  [SQL::MariaDB, MariaDBInsert::class],
  [SQL::MySQL, MySQLInsert::class],
  [SQL::PostgreSQL, PostgreSQLInsert::class],
  [SQL::SQLite, SQLiteInsert::class],
  [SQL::TransactSQL, TransactSQLInsert::class],
]);

it("can replace", function (SQL $sql, $class)
{

  expect($stmt = $sql->replace([1]))
  ->toBeInstanceOf($class);

  expect((string) $stmt)
  ->toBe("REPLACE VALUES (1)");

})
->with([
  [SQL::MariaDB, MariaDBReplace::class],
  [SQL::MySQL, MySQLReplace::class],
  [SQL::SQLite, SQLiteReplace::class],
]);

it("cannot replace", function (SQL $sql)
{
  $sql->replace();
})
->throws(BadMethodCallException::class)
->with([SQL::PostgreSQL, SQL::TransactSQL]);

it("can select", function (SQL $sql, $class)
{

  expect($stmt = $sql->select("c1"))
  ->toBeInstanceOf($class);

  expect((string) $stmt)
  ->toBe("SELECT " . $sql->quote("c1"));

})
->with([
  [SQL::MariaDB, MariaDBSelect::class],
  [SQL::MySQL, MySQLSelect::class],
  [SQL::PostgreSQL, PostgreSQLSelect::class],
  [SQL::SQLite, SQLiteSelect::class],
  [SQL::TransactSQL, TransactSQLSelect::class],
]);

it("can update", function (SQL $sql, $class)
{

  expect($stmt = $sql->update("t1"))
  ->toBeInstanceOf($class);

  expect((string) $stmt)
  ->toBe("UPDATE " . $sql->quote("t1"));

})
->with([
  [SQL::MariaDB, MariaDBUpdate::class],
  [SQL::MySQL, MySQLUpdate::class],
  [SQL::PostgreSQL, PostgreSQLUpdate::class],
  [SQL::SQLite, SQLiteUpdate::class],
  [SQL::TransactSQL, TransactSQLUpdate::class],
]);

it("can get cte", function (SQL $sql, $class)
{

  expect($sql->cte("cte", "SELECT *"))
  ->toBeInstanceOf($class);

})
->with([
  [SQL::MariaDB, MariaDBCTE::class],
  [SQL::MySQL, MySQLCTE::class],
  [SQL::PostgreSQL, PostgreSQLCTE::class],
  [SQL::SQLite, SQLiteCTE::class],
  [SQL::TransactSQL, TransactSQLCTE::class],
]);

it("can get subquery", function (SQL $sql, $class)
{

  expect($sql->subquery("SELECT *"))
  ->toBeInstanceOf($class);

})
->with([
  [SQL::MariaDB, MariaDBSubquery::class],
  [SQL::MySQL, MySQLSubquery::class],
  [SQL::PostgreSQL, PostgreSQLSubquery::class],
  [SQL::SQLite, SQLiteSubquery::class],
  [SQL::TransactSQL, TransactSQLSubquery::class],
]);

it("can get table", function (SQL $sql, $class)
{

  expect($sql->table("t1"))
  ->toBeInstanceOf($class);

})
->with([
  [SQL::MariaDB, MariaDBTable::class],
  [SQL::MySQL, MySQLTable::class],
  [SQL::PostgreSQL, PostgreSQLTable::class],
  [SQL::SQLite, SQLiteTable::class],
  [SQL::TransactSQL, TransactSQLTable::class],
]);

it("can bind value", function ($value)
{

  expect($raw = SQL::bind($value))
  ->toBeInstanceOf(Raw::class);

  expect((string) $raw)
  ->toBe("?");

  expect($raw->bindings())
  ->toBe([$value]);

})
->with(["test", 1, 1.1, true]);

it("can convert", function ($input, $output, $bind_string = false)
{

  $sql = SQL::SQLite;

  expect($sql->convert($input, $bind_string))
  ->toEqual($output);

})
->with([
  ["c1", '"c1"'],
  ["c1", new Raw("?", ["c1"]), true],
  [new Raw("?", 1), new Raw("?", 1)],
  [SQL::SQLite->select(), SQL::SQLite->subquery("SELECT *")],
  [1, 1],
  [1.1, 1.1],
  [true, new Raw("?", true)],
  [null, "NULL"],
  [["c1", "c2"], ['"c1"', '"c2"']],
]);

it("can quote identifier", function (SQL $sql, $input, $output)
{

  expect($sql->quote($input))
  ->toBe($output);

})
->with([
  [SQL::MariaDB, "te`st.test", "`te``st`.`test`"],
  [SQL::MySQL, "te`st.test", "`te``st`.`test`"],
  [SQL::PostgreSQL, 'te"st.test', '"te""st"."test"'],
  [SQL::SQLite, 'te"st.test', '"te""st"."test"'],
  [SQL::TransactSQL, "te]st.test", "[te]]st].[test]"],
  [SQL::MariaDB, "test.*", "`test`.*"],
  [SQL::MySQL, "test.*", "`test`.*"],
  [SQL::PostgreSQL, "test.*", '"test".*'],
  [SQL::SQLite, "test.*", '"test".*'],
  [SQL::TransactSQL, "test.*", "[test].*"],
]);

it("can get with alias", function ($table, $class, $output, $alias = null)
{

  $sql = SQL::SQLite;

  expect($table = $sql->toTable($table, $alias))
  ->toBeInstanceOf($class);

  expect((string) $table)
  ->toBe($output);

})
->with([
  ["t1", Table::class, '"t1"'],
  ["t1", Table::class, '"t1"', 0],
  ["t1", Table::class, '"t1" AS "t2"', "t2"],
  [SQL::SQLite->table("t1")->as("t2"), Table::class, '"t1" AS "t2"'],
  [SQL::SQLite->table("t1")->as("t2"), Table::class, '"t1" AS "t2"', 0],
  [SQL::SQLite->table("t1")->as("t2"), Table::class, '"t1" AS "t3"', "t3"],
  [new Raw("t1"), Expression::class, "t1"],
  [new Raw("t1"), Expression::class, "t1", 0],
  [new Raw("t1"), Expression::class, 't1 AS "t2"', "t2"],
  [SQL::SQLite->select(), Subquery::class, "(SELECT *)"],
  [SQL::SQLite->select(), Subquery::class, "(SELECT *)", 0],
  [SQL::SQLite->select(), Subquery::class, '(SELECT *) AS "t1"', "t1"],
]);

it("can escape string", function ()
{

  expect(SQL::escape("'string'"))
  ->toBe("''string''");

});