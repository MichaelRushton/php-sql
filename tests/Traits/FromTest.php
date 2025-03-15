<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("from", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->from($table))
  ->toBe("SELECT * FROM $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1", "t2" AS "t3"'],
]);

test("from raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->fromRaw("?", $bindings))
  ->toBe("SELECT * FROM ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);