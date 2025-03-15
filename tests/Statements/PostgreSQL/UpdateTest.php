<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\PostgreSQL\Update;

test("update", function ()
{

  expect(
    (string) (new Update)
    ->with("cte", "SELECT *")
    ->table("t1")
    ->set("c1")
    ->from("t1")
    ->join("t1")
    ->where("c1")
    ->whereCurrentOf("cursor")
    ->returning()
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    'WITH "cte" AS (SELECT *)',
    "UPDATE",
    '"t1"',
    'SET "c1" = NULL',
    'FROM "t1"',
    'JOIN "t1"',
    'WHERE "c1"',
    'WHERE CURRENT OF "cursor"',
    "RETURNING *",
  ]));

});