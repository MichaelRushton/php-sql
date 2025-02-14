<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("using", function ($table, $output, $bindings = [])
{

  expect((string) $stmt = SQL::PostgreSQL->delete()->using($table))
  ->toBe("DELETE USING $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["t1", '"t1"'],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t3" => "t2"], '"t1", "t2" AS "t3"'],
]);

test("using raw", function ($bindings)
{

  expect((string) $stmt = SQL::PostgreSQL->delete()->usingRaw("?", $bindings))
  ->toBe("DELETE USING ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);