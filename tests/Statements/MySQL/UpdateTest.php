<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update;

test("update", function () {

    expect(
        (string) (new Update(SQL::MySQL))
    ->with("cte", "SELECT")
    ->lowPriority()
    ->ignore()
    ->table("t1")
    ->join("t1")
    ->set("c1", 1)
    ->where("c1")
    ->orderBy("c1")
    ->limit(1)
    )
    ->toBe(implode(" ", [
      "WITH cte AS (SELECT)",
      "UPDATE",
      "LOW_PRIORITY",
      "IGNORE",
      "t1",
      "JOIN t1",
      "SET c1 = ?",
      "WHERE c1",
      "ORDER BY c1",
      "LIMIT 1",
    ]));

});
