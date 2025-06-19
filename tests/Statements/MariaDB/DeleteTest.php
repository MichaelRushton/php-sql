<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete;

test("delete", function ()
{

  expect(
    (string) (new Delete(SQL::MariaDB))
    ->lowPriority()
    ->quick()
    ->ignore()
    ->table("t1")
    ->from("t1")
    ->using("t1")
    ->join("t1")
    ->where("c1")
    ->orderBy("c1")
    ->limit(1)
    ->returning()
  )
  ->toBe(implode(" ", [
    "DELETE",
    "LOW_PRIORITY",
    "QUICK",
    "IGNORE",
    "t1",
    "FROM t1",
    "USING t1",
    "JOIN t1",
    "WHERE c1",
    "ORDER BY c1",
    "LIMIT 1",
    "RETURNING *",
  ]));

});