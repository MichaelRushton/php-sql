<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("update", function ()
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->with("cte", "SELECT")
    ->distinct()
    ->columns("c1")
    ->from("t1")
    ->join("t1")
    ->where("c1", 1)
    ->groupBy("c1")
    ->having("c1", 1)
    ->window("w")
    ->union("SELECT")
    ->orderBy("c1")
    ->limit(1)
  )
  ->toBe(
    implode(" ", [
      "WITH cte AS (SELECT)",
      "SELECT",
      "DISTINCT",
      "c1",
      "FROM t1",
      "JOIN t1",
      "WHERE c1 = ?",
      "GROUP BY c1",
      "HAVING c1 = ?",
      "WINDOW w AS ()",
      "UNION SELECT",
      "ORDER BY c1",
      "LIMIT 1",
    ])
  );

  expect($stmt->bindings())
  ->toBe([1, 1]);

});