<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\TransactSQL\Select;

test("select", function ()
{

  expect(
    (string) (new Select)
    ->with("cte", "SELECT *")
    ->distinct()
    ->top(1)
    ->select("c1")
    ->from("t1")
    ->join("t1")
    ->where("c1")
    ->groupBy("c1")
    ->having("c1")
    ->window("w")
    ->union("SELECT *")
    ->orderBy("c1")
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "WITH [cte] AS (SELECT *)",
    "SELECT",
    "DISTINCT",
    "TOP (1)",
    "[c1]",
    "FROM [t1]",
    "JOIN [t1]",
    "WHERE [c1]",
    "GROUP BY [c1]",
    "HAVING [c1]",
    "WINDOW [w] AS ()",
    "UNION SELECT *",
    "ORDER BY [c1]",
  ]));

});

test("select offset fetch", function ()
{

  expect(
    (string) (new Select)
    ->orderBy("c1")
    ->offsetFetch(1, 2)
  )
  ->toBe(implode(" ", [
    "SELECT",
    "*",
    "ORDER BY [c1]",
    "OFFSET 1 ROWS FETCH NEXT 2 ROWS ONLY",
  ]));

});