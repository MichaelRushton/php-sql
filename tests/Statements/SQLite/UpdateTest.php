<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\SQLite\Update;

test("update", function ()
{

  expect(
    (string) (new Update)
    ->with("cte", "SELECT *")
    ->orFail()
    ->table("t1")
    ->set("c1")
    ->from("t1")
    ->join("t1")
    ->where("c1")
    ->returning()
    ->orderBy("c1")
    ->limit(1)
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    'WITH "cte" AS (SELECT *)',
    "UPDATE",
    "OR FAIL",
    '"t1"',
    'SET "c1" = NULL',
    'FROM "t1"',
    'JOIN "t1"',
    'WHERE "c1"',
    "RETURNING *",
    'ORDER BY "c1"',
    "LIMIT 1",
  ]));

});