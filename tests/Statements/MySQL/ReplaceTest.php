<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Replace;

test("replace", function ()
{

  expect(
    (string) $stmt = (new Replace(SQL::MySQL))
    ->lowPriority()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->set("c1", 1)
    ->select("SELECT")
  )
  ->toBe(
    implode(" ", [
      "INSERT",
      "LOW_PRIORITY",
      "INTO t1",
      "(c1)",
      "VALUES (?)",
      "SET c1 = ?",
      "SELECT",
    ])
  );

  expect($stmt->bindings())
  ->toBe([1, 1]);

});