<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\Update;

test("delete", function (SQL $sql)
{

  expect($stmt = $sql->delete())
  ->toBeInstanceOf(Delete::class);

  expect($stmt->sql())
  ->toBe($sql);

})
->with(SQL::cases());

test("insert", function (SQL $sql)
{

  expect($stmt = $sql->insert())
  ->toBeInstanceOf(Insert::class);

  expect($stmt->sql())
  ->toBe($sql);

})
->with(SQL::cases());

test("replace", function (SQL $sql)
{

  expect($stmt = $sql->replace())
  ->toBeInstanceOf(Replace::class);

  expect($stmt->sql())
  ->toBe($sql);

})
->with([
  SQL::MariaDB,
  SQL::MySQL,
  SQL::SQLite,
]);

test("cannot replace", function (SQL $sql)
{
  $sql->replace();
})
->throws(BadMethodCallException::class)
->with([
  SQL::PostgreSQL,
  SQL::TransactSQL,
]);

test("select", function (SQL $sql)
{

  expect($stmt = $sql->select())
  ->toBeInstanceOf(Select::class);

  expect($stmt->sql())
  ->toBe($sql);

})
->with(SQL::cases());

test("update", function (SQL $sql)
{

  expect($stmt = $sql->update())
  ->toBeInstanceOf(Update::class);

  expect($stmt->sql())
  ->toBe($sql);

})
->with(SQL::cases());

test("bind", function ($value)
{

  expect($binding = SQL::bind($value))
  ->toBeInstanceOf(Raw::class);

  expect("$binding")
  ->toBe("?");

  expect($binding->bindings())
  ->toBe([$value]);

})
->with(["test", 1, 1.1, true, null]);

test("escape", function ()
{

  expect(SQL::escape("'string'"))
  ->toBe("''string''");

});