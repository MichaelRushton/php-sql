<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("union", function ($stmt, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->union($stmt)
  )
  ->toBe("SELECT * UNION $expected");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT", "SELECT"],
  [new Raw("?", 1), "?", [1]],
  [fn (Select $stmt) => $stmt->where("c1", 1), "SELECT * WHERE c1 = ?", [1]],
  [["SELECT 1", "SELECT 2"], "SELECT 1 UNION SELECT 2"],
]);

test("union all", function ($stmt, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->unionAll($stmt)
  )
  ->toBe("SELECT * UNION ALL $expected");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT", "SELECT"],
  [new Raw("?", 1), "?", [1]],
  [fn (Select $stmt) => $stmt->where("c1", 1), "SELECT * WHERE c1 = ?", [1]],
  [["SELECT 1", "SELECT 2"], "SELECT 1 UNION ALL SELECT 2"],
]);

test("intersect", function ($stmt, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->intersect($stmt)
  )
  ->toBe("SELECT * INTERSECT $expected");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT", "SELECT"],
  [new Raw("?", 1), "?", [1]],
  [fn (Select $stmt) => $stmt->where("c1", 1), "SELECT * WHERE c1 = ?", [1]],
  [["SELECT 1", "SELECT 2"], "SELECT 1 INTERSECT SELECT 2"],
]);

test("intersect all", function ($stmt, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->intersectAll($stmt)
  )
  ->toBe("SELECT * INTERSECT ALL $expected");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT", "SELECT"],
  [new Raw("?", 1), "?", [1]],
  [fn (Select $stmt) => $stmt->where("c1", 1), "SELECT * WHERE c1 = ?", [1]],
  [["SELECT 1", "SELECT 2"], "SELECT 1 INTERSECT ALL SELECT 2"],
]);

test("except", function ($stmt, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->except($stmt)
  )
  ->toBe("SELECT * EXCEPT $expected");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT", "SELECT"],
  [new Raw("?", 1), "?", [1]],
  [fn (Select $stmt) => $stmt->where("c1", 1), "SELECT * WHERE c1 = ?", [1]],
  [["SELECT 1", "SELECT 2"], "SELECT 1 EXCEPT SELECT 2"],
]);

test("except all", function ($stmt, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->exceptAll($stmt)
  )
  ->toBe("SELECT * EXCEPT ALL $expected");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT", "SELECT"],
  [new Raw("?", 1), "?", [1]],
  [fn (Select $stmt) => $stmt->where("c1", 1), "SELECT * WHERE c1 = ?", [1]],
  [["SELECT 1", "SELECT 2"], "SELECT 1 EXCEPT ALL SELECT 2"],
]);