<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\Upsert;
use MichaelRushton\SQL\Services\Where;
use MichaelRushton\SQL\SQL;

test("single expression where index", function ($input, $output, $bindings = [])
{

  expect((string) $stmt = (new Upsert(SQL::SQLite))->whereIndex($input))
  ->toBe("WHERE $output DO NOTHING");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", '"c1"'],
  [new Raw("?", 1), "?", [1]],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["c1" => 1, "c2" => "test"], '"c1" = ? AND "c2" = ?', [1, "test"]],
  [fn (Where $where) => $where->where(true), "?", [true]],
]);

test("implicit operator where index", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = (new Upsert(SQL::SQLite))->whereIndex($column, $input))
  ->toBe("WHERE $output DO NOTHING");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["test", '"c1" = ?', ["test"]],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["test1", "test2"], '"c1" IN (?, ?)', ["test1", "test2"]],
  [["test1", "test2"], '("c1", "c2") = (?, ?)', ["test1", "test2"], ["c1", "c2"]],
]);

test("explicit expression where index", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = (new Upsert(SQL::SQLite))->whereIndex("c1", $operator, $input))
  ->toBe("WHERE \"c1\" $operator $output DO NOTHING");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["test", "?", ["test"]],
  [new Raw("?", 1), "?", [1]],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [null, "NULL"],
  [["test1", "test2"], "(?, ?)", ["test1", "test2"]],
  [["test1", "test2"], "? AND ?", ["test1", "test2"], "BETWEEN"],
]);