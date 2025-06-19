<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("insert", function ()
{

  expect(
    (string) $stmt = (new Insert(SQL::PostgreSQL))
    ->with("cte", "SELECT")
    ->into("t1")
    ->columns("c1")
    ->overridingSystemValue()
    ->values([1])
    ->select("SELECT")
    ->onConflictDoNothing()
    ->returning()
  )
  ->toBe(
    implode(" ", [
      "WITH cte AS (SELECT)",
      "INSERT",
      "INTO t1",
      "(c1)",
      "OVERRIDING SYSTEM VALUE",
      "VALUES (?)",
      "SELECT",
      "ON CONFLICT DO NOTHING",
      "RETURNING *",
    ])
  );

  expect($stmt->bindings())
  ->toBe([1]);

});