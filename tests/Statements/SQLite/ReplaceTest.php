<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Replace;

test("replace", function ()
{

  expect(
    (string) $stmt = (new Replace(SQL::SQLite))
    ->with("cte", "SELECT")
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->select("SELECT")
    ->returning()
  )
  ->toBe(
    implode(" ", [
      "WITH cte AS (SELECT)",
      "INSERT",
      "INTO t1",
      "(c1)",
      "VALUES (?)",
      "SELECT",
      "RETURNING *",
    ])
  );

  expect($stmt->bindings())
  ->toBe([1]);

});