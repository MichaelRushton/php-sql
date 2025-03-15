<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\SQLite\Select;

test("select", function ($stmt, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->insert()->select($stmt))
  ->toBe("INSERT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT *", "SELECT *"],
  [new Raw("SELECT *", 1), "SELECT *", [1]],
  [fn (Select $stmt) => $stmt->select("c1"), 'SELECT "c1"'],
]);