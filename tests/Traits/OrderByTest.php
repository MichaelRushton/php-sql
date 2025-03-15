<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("order by", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->orderBy($column))
  ->toBe("SELECT * ORDER BY $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("order by desc", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->orderByDesc($column))
  ->toBe("SELECT * ORDER BY $output DESC");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], '"c1" DESC, "c2"'],
]);

test("order by nulls first", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->orderByNullsFirst($column))
  ->toBe("SELECT * ORDER BY $output ASC NULLS FIRST");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], '"c1" ASC NULLS FIRST, "c2"'],
]);

test("order by nulls last", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->orderByNullsLast($column))
  ->toBe("SELECT * ORDER BY $output ASC NULLS LAST");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], '"c1" ASC NULLS LAST, "c2"'],
]);

test("order by desc nulls first", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->orderByDescNullsFirst($column))
  ->toBe("SELECT * ORDER BY $output DESC NULLS FIRST");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], '"c1" DESC NULLS FIRST, "c2"'],
]);

test("order by desc nulls last", function ($column, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->orderByDescNullsLast($column))
  ->toBe("SELECT * ORDER BY $output DESC NULLS LAST");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], '"c1" DESC NULLS LAST, "c2"'],
]);

test("order by raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->orderByRaw("?", $bindings))
  ->toBe("SELECT * ORDER BY ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("order by desc raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->orderByDescRaw("?", $bindings))
  ->toBe("SELECT * ORDER BY ? DESC");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("order by nulls first raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->orderByNullsFirstRaw("?", $bindings))
  ->toBe("SELECT * ORDER BY ? ASC NULLS FIRST");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("order by nulls last raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->orderByNullsLastRaw("?", $bindings))
  ->toBe("SELECT * ORDER BY ? ASC NULLS LAST");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("order by desc nulls first raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->orderByDescNullsFirstRaw("?", $bindings))
  ->toBe("SELECT * ORDER BY ? DESC NULLS FIRST");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("order by desc nulls last raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->orderByDescNullsLastRaw("?", $bindings))
  ->toBe("SELECT * ORDER BY ? DESC NULLS LAST");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);