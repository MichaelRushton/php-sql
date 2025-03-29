<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update;

test("update", function ()
{

  expect(
    (string) (new Update(SQL::PostgreSQL))
    ->with("cte", "SELECT")
    ->table("t1")
    ->set("c1", 1)
    ->from("t1")
    ->join("t1")
    ->where("c1")
    ->whereCurrentOf("cursor")
    ->returning()
  )
  ->toBe(implode(" ", [
    "WITH cte AS (SELECT)",
    "UPDATE",
    "t1",
    "SET c1 = ?",
    "FROM t1",
    "JOIN t1",
    "WHERE c1",
    "WHERE CURRENT OF cursor",
    "RETURNING *",
  ]));

});