<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\MySQL\Delete;

test("delete", function ()
{

  expect(
    (string) (new Delete)
    ->with("cte", "SELECT *")
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
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "WITH `cte` AS (SELECT *)",
    "DELETE",
    "LOW_PRIORITY",
    "QUICK",
    "IGNORE",
    "`t1`",
    "FROM `t1`",
    "USING `t1`",
    "JOIN `t1`",
    "WHERE `c1`",
    "ORDER BY `c1`",
    "LIMIT 1",
  ]));

});