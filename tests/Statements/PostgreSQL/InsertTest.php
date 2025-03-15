<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\PostgreSQL\Insert;

test("insert", function ()
{

  expect(
    (string) (new Insert)
    ->with("cte", "SELECT *")
    ->into("t1")
    ->columns("c1")
    ->overridingSystemValue()
    ->values([1])
    ->select("SELECT *")
    ->onConflictDoNothing()
    ->returning()
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    'WITH "cte" AS (SELECT *)',
    "INSERT",
    'INTO "t1"',
    '("c1")',
    "OVERRIDING SYSTEM VALUE",
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