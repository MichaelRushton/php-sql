<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("select", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select($column))
  ->toBe("SELECT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  ["*", "*"],
  [new Raw("?", 1), "?", [1]],
  [SQL::SQLite->select(), "(SELECT *)"],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("select with alias", function ($column, $output)
{

  expect((string) SQL::SQLite->select($column))
  ->toBe("SELECT $output");

})
->with([
  [["c2" => "c1"], '"c1" AS "c2"'],
  [["c2" => new Raw("c1")], 'c1 AS "c2"'],
  [["c1" => SQL::SQLite->select()], '(SELECT *) AS "c1"'],
]);

test("select raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->selectRaw("?", $bindings))
  ->toBe("SELECT ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);