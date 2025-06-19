<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete;

test("delete", function ()
{

  expect(
    (string) (new Delete(SQL::PostgreSQL))
    ->with("cte", "SELECT")
    ->from("t1")
    ->join("t1")
    ->using("t1")
    ->where("c1")
    ->whereCurrentOf("cursor")
    ->returning()
  )
  ->toBe(implode(" ", [
    "WITH cte AS (SELECT)",
    "DELETE",
    "FROM t1",
    "USING t1",
    "JOIN t1",
    "WHERE c1",
    "WHERE CURRENT OF cursor",
    "RETURNING *",
  ]));

});