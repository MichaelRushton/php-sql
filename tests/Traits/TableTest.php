<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("table", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->update()->table($table))
  ->toBe("UPDATE $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1", "t2" AS "t3"'],
]);

test("table raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->update()->tableRaw("?", $bindings))
  ->toBe("UPDATE ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);