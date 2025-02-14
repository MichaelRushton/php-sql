<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\MariaDB\Delete;

test("delete", function ()
{

  expect(
    (string) (new Delete)
    ->lowPriority()
    ->quick()
    ->ignore()
    ->history()
    ->table("t1")
    ->from("t1")
    ->using("t1")
    ->join("t1")
    ->where("c1")
    ->orderBy("c1")
    ->limit(1)
    ->returning()
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "DELETE",
    "LOW_PRIORITY",
    "QUICK",
    "IGNORE",
    "HISTORY",
    "`t1`",
    "FROM `t1`",
    "USING `t1`",
    "JOIN `t1`",
    "WHERE `c1`",
    "ORDER BY `c1`",
    "LIMIT 1",
    "RETURNING *",
  ]));

});