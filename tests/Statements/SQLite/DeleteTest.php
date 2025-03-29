<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete;

test("delete", function ()
{

  expect(
    (string) (new Delete(SQL::SQLite))
    ->with("cte", "SELECT")
    ->from("t1")
    ->where("c1")
    ->returning()
    ->orderBy("c1")
    ->limit(1)
  )
  ->toBe(implode(" ", [
    "WITH cte AS (SELECT)",
    "DELETE",
    "FROM t1",
    "WHERE c1",
    "RETURNING *",
    "ORDER BY c1",
    "LIMIT 1",
  ]));

});