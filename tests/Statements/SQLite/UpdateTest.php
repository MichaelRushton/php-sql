<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update;

test("update", function ()
{

  expect(
    (string) (new Update(SQL::SQLite))
    ->orFail()
    ->table("t1")
    ->set("c1", 1)
    ->from("t1")
    ->join("t1")
    ->where("c1")
    ->returning()
    ->orderBy("c1")
    ->limit(1)
  )
  ->toBe(implode(" ", [
    "UPDATE",
    "OR FAIL",
    "t1",
    "SET c1 = ?",
    "FROM t1",
    "JOIN t1",
    "WHERE c1",
    "RETURNING *",
    "ORDER BY c1",
    "LIMIT 1",
  ]));

});