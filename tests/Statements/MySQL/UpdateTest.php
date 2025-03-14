<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\MySQL\Update;

test("update", function ()
{

  expect(
    (string) (new Update)
    ->with("cte", "SELECT *")
    ->lowPriority()
    ->ignore()
    ->table("t1")
    ->join("t1")
    ->set("c1")
    ->where("c1")
    ->orderBy("c1")
    ->limit(1)
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "WITH `cte` AS (SELECT *)",
    "UPDATE",
    "LOW_PRIORITY",
    "IGNORE",
    "`t1`",
    "JOIN `t1`",
    "SET `c1` = NULL",
    "WHERE `c1`",
    "ORDER BY `c1`",
    "LIMIT 1",
  ]));

});