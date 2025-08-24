<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete;

test("delete", function () {

    expect(
        (string) (new Delete(SQL::TransactSQL))
    ->with("cte", "SELECT")
    ->top(1)
    ->table("t1")
    ->output("*")
    ->from("t1")
    ->join("t1")
    ->where("c1")
    ->whereCurrentOf("cursor")
    )
    ->toBe(implode(" ", [
      "WITH cte AS (SELECT)",
      "DELETE",
      "TOP (1)",
      "t1",
      "OUTPUT *",
      "FROM t1",
      "JOIN t1",
      "WHERE c1",
      "WHERE CURRENT OF cursor",
    ]));

});
