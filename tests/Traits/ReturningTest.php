<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("returning", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::PostgreSQL->delete()->returning($column))
  ->toBe("DELETE RETURNING $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  ["*", "*"],
  [new Raw("?", 1), "?", [1]],
  [SQL::PostgreSQL->select(), "(SELECT *)"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [null, "NULL"],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("returning with alias", function ($column, $output)
{

  expect((string) SQL::PostgreSQL->delete()->returning($column))
  ->toBe("DELETE RETURNING $output");

})
->with([
  [["c2" => "c1"], '"c1" AS "c2"'],
  [["c2" => new Raw("c1")], 'c1 AS "c2"'],
  [["c1" => SQL::PostgreSQL->select()], '(SELECT *) AS "c1"'],
]);

test("returning raw", function ($bindings)
{

  expect((string) $stmt = SQL::PostgreSQL->delete()->returningRaw("?", $bindings))
  ->toBe("DELETE RETURNING ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);