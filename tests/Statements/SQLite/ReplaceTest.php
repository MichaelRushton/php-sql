<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\SQLite\Replace;

test("replace", function ()
{

  expect(
    (string) (new Replace)
    ->with("cte", "SELECT *")
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->select("SELECT *")
    ->returning()
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    'WITH "cte" AS (SELECT *)',
    "REPLACE",
    'INTO "t1"',
    '("c1")',
    "VALUES (1)",
    "SELECT *",
    "RETURNING *",
  ]));

});

test("replace default", function ()
{

  expect((string) new Replace)
  ->toBe("REPLACE DEFAULT VALUES");

});