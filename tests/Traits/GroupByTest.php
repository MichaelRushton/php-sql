<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("group by", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->groupBy($column))
  ->toBe("SELECT * GROUP BY $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("group by raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->groupByRaw("?", $bindings))
  ->toBe("SELECT * GROUP BY ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("with rollup", function ()
{

  expect(
    (string) SQL::SQLite->select()
    ->groupBy("c1")
    ->withRollup()
  )
  ->toBe('SELECT * GROUP BY "c1" WITH ROLLUP');

});