<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\Window;
use MichaelRushton\SQL\SQL;

test("partition by", function ($column, $output, $bindings = [])
{

  expect((string) $window = (new Window(SQL::SQLite, "w"))->partitionBy($column))
  ->toBe("\"w\" AS (PARTITION BY $output)");

  expect($window->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("partition by raw", function ($bindings)
{

  expect((string) $window = (new Window(SQL::SQLite, "w"))->partitionByRaw("?", $bindings))
  ->toBe('"w" AS (PARTITION BY ?)');

  expect($window->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);