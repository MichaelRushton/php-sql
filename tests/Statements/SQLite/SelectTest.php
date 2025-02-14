<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\SQLite\Select;

test("select", function ()
{

  expect(
    (string) (new Select)
    ->with("cte", "SELECT *")
    ->distinct()
    ->select("c1")
    ->from("t1")
    ->join("t1")
    ->where("c1")
    ->groupBy("c1")
    ->having("c1")
    ->window("w")
    ->union("SELECT *")
    ->orderBy("c1")
    ->limit(1, 2)
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    'WITH "cte" AS (SELECT *)',
    "SELECT",
    "DISTINCT",
    '"c1"',
    'FROM "t1"',
    'JOIN "t1"',
    'WHERE "c1"',
    'GROUP BY "c1"',
    'HAVING "c1"',
    'WINDOW "w" AS ()',
    "UNION SELECT *",
    'ORDER BY "c1"',
    "LIMIT 1",
    "OFFSET 2",
  ]));

});