<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\SQLite\Select;

test("union", function ($stmt, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->union($stmt))
  ->toBe("SELECT * UNION $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT *", "SELECT *"],
  [new Raw("SELECT *", 1), "SELECT *", [1]],
  [fn (Select $stmt) => $stmt->select("c1"), 'SELECT "c1"'],
  [["SELECT *", "SELECT *"], "SELECT * UNION SELECT *"],
]);

test("union all", function ($stmt, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->unionAll($stmt))
  ->toBe("SELECT * UNION ALL $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT *", "SELECT *"],
  [new Raw("SELECT *", 1), "SELECT *", [1]],
  [fn (Select $stmt) => $stmt->select("c1"), 'SELECT "c1"'],
  [["SELECT *", "SELECT *"], "SELECT * UNION ALL SELECT *"],
]);

test("intersect", function ($stmt, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->intersect($stmt))
  ->toBe("SELECT * INTERSECT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT *", "SELECT *"],
  [new Raw("SELECT *", 1), "SELECT *", [1]],
  [fn (Select $stmt) => $stmt->select("c1"), 'SELECT "c1"'],
  [["SELECT *", "SELECT *"], "SELECT * INTERSECT SELECT *"],
]);

test("intersect all", function ($stmt, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->intersectAll($stmt))
  ->toBe("SELECT * INTERSECT ALL $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT *", "SELECT *"],
  [new Raw("SELECT *", 1), "SELECT *", [1]],
  [fn (Select $stmt) => $stmt->select("c1"), 'SELECT "c1"'],
  [["SELECT *", "SELECT *"], "SELECT * INTERSECT ALL SELECT *"],
]);

test("except", function ($stmt, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->except($stmt))
  ->toBe("SELECT * EXCEPT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT *", "SELECT *"],
  [new Raw("SELECT *", 1), "SELECT *", [1]],
  [fn (Select $stmt) => $stmt->select("c1"), 'SELECT "c1"'],
  [["SELECT *", "SELECT *"], "SELECT * EXCEPT SELECT *"],
]);

test("except all", function ($stmt, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->exceptAll($stmt))
  ->toBe("SELECT * EXCEPT ALL $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT *", "SELECT *"],
  [new Raw("SELECT *", 1), "SELECT *", [1]],
  [fn (Select $stmt) => $stmt->select("c1"), 'SELECT "c1"'],
  [["SELECT *", "SELECT *"], "SELECT * EXCEPT ALL SELECT *"],
]);