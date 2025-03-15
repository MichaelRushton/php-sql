<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\SQLite\Insert;

test("insert", function ()
{

  expect(
    (string) (new Insert)
    ->with("cte", "SELECT *")
    ->orFail()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->select("SELECT *")
    ->onConflictDoNothing()
    ->returning()
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    'WITH "cte" AS (SELECT *)',
    "INSERT",
    "OR FAIL",
    'INTO "t1"',
    '("c1")',
    "VALUES (?)",
    "SELECT *",
    "ON CONFLICT DO NOTHING",
    "RETURNING *",
  ]));

});

test("insert default", function ()
{

  expect((string) new Insert)
  ->toBe("INSERT DEFAULT VALUES");

});