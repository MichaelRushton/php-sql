<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\CTE;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\SQLite\Select;

test("with", function ($stmt, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->with("cte", $stmt, function (CTE $cte)
  {

  }))
  ->toBe('WITH "cte" AS (SELECT "c1") SELECT *');

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ['SELECT "c1"'],
  [new Raw('SELECT "c1"', 1), [1]],
  [SQL::SQLite->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), []],
]);

test("multiple withs", function ()
{

  expect(
    (string) SQL::SQLite->select()
    ->with("cte1", "SELECT *")
    ->with("cte2", "SELECT *")
  )
  ->toBe('WITH "cte1" AS (SELECT *), "cte2" AS (SELECT *) SELECT *');

});

test("recursive", function ()
{

  expect(
    (string) SQL::SQLite->select()
    ->with("cte1", "SELECT *")
    ->recursive()
  )
  ->toBe('WITH RECURSIVE "cte1" AS (SELECT *) SELECT *');

});