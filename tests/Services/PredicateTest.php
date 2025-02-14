<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Predicate;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("single expression", function ($input, $output, $bindings = [])
{

  expect((string) $predicate = new Predicate(SQL::SQLite, $input))
  ->toBe($output);

  expect($predicate->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [null, "NULL"],
  [["c1", "c2"], '("c1", "c2")'],
]);

test("implicit operator", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $predicate = new Predicate(SQL::SQLite, $column, $input))
  ->toBe($output);

  expect($predicate->bindings())
  ->toBe($bindings);

})
->with([
  ["test", '"c1" = ?', ["test"]],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = 1'],
  [1.1, '"c1" = 1.1'],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["test1", "test2"], '"c1" IN (?, ?)', ["test1", "test2"]],
  [["test1", "test2"], '("c1", "c2") = (?, ?)', ["test1", "test2"], ["c1", "c2"]],
]);

test("explicit expression", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $predicate = new Predicate(SQL::SQLite, "c1", $operator, $input))
  ->toBe("\"c1\" $operator $output");

  expect($predicate->bindings())
  ->toBe($bindings);

})
->with([
  ["test", "?", ["test"]],
  [new Raw("?", 1), "?", [1]],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [null, "NULL"],
  [["test1", "test2"], "(?, ?)", ["test1", "test2"]],
  [["test1", "test2"], "? AND ?", ["test1", "test2"], "BETWEEN"],
]);