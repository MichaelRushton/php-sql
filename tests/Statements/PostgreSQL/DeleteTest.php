<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\PostgreSQL\Delete;

test("delete", function ()
{

  expect(
    (string) (new Delete)
    ->with("cte", "SELECT *")
    ->from("t1")
    ->using("t1")
    ->join("t1")
    ->where("c1")
    ->whereCurrentOf("cursor")
    ->returning()
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    'WITH "cte" AS (SELECT *)',
    "DELETE",
    'FROM "t1"',
    'USING "t1"',
    'JOIN "t1"',
    'WHERE "c1"',
    'WHERE CURRENT OF "cursor"',
    "RETURNING *",
  ]));

});