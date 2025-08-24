<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("select", function () {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->with("cte", "SELECT")
    ->distinct()
    ->columns("c1")
    ->from("t1")
    ->join("t1")
    ->where("c1")
    ->groupBy("c1")
    ->having("c1")
    ->window("w")
    ->union("SELECT")
    ->orderBy("c1")
    ->limit(1)
    ->forUpdate()
    ->forNoKeyUpdate()
    ->forShare()
    ->forKeyShare()
    )
    ->toBe(implode(" ", [
      "WITH cte AS (SELECT)",
      "SELECT",
      "DISTINCT",
      "c1",
      "FROM t1",
      "JOIN t1",
      "WHERE c1",
      "GROUP BY c1",
      "HAVING c1",
      "WINDOW w AS ()",
      "UNION SELECT",
      "ORDER BY c1",
      "LIMIT 1",
      "FOR UPDATE",
      "FOR NO KEY UPDATE",
      "FOR SHARE",
      "FOR KEY SHARE",
    ]));

});

test("select offset fetch", function () {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->orderBy("c1")
    ->offsetFetch(1, 2)
    ->withTies()
    ->forUpdate()
    )
    ->toBe(implode(" ", [
      "SELECT",
      "*",
      "ORDER BY c1",
      "OFFSET 1 ROWS FETCH NEXT 2 ROWS WITH TIES",
      "FOR UPDATE",
    ]));

});
