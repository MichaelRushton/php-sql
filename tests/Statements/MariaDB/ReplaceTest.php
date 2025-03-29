<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Replace;

test("replace", function ()
{

  expect(
    (string) $stmt = (new Replace(SQL::MariaDB))
    ->lowPriority()
    ->delayed()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->set("c1", 1)
    ->select("SELECT")
    ->returning()
  )
  ->toBe(
    implode(" ", [
      "INSERT",
      "LOW_PRIORITY",
      "DELAYED",
      "INTO t1",
      "(c1)",
      "VALUES (?)",
      "SET c1 = ?",
      "SELECT",
      "RETURNING *",
    ])
  );

  expect($stmt->bindings())
  ->toBe([1, 1]);

});