<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\Where;
use MichaelRushton\SQL\SQL;

test("single expression where", function ($input, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->where($input))
  ->toBe("SELECT * WHERE $output");

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

test("implicit operator where", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->where($column, $input))
  ->toBe("SELECT * WHERE $output");

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

test("explicit expression where", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->where("c1", $operator, $input))
  ->toBe("SELECT * WHERE \"c1\" $operator $output");

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

test("single expression or where", function ($input, $output, $bindings = [])
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c0")
    ->orWhere($input)
  )
  ->toBe("SELECT * WHERE \"c0\" OR $output");

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
  [["c1" => 1, "c2" => "test"], '"c1" = ? OR "c2" = ?', [1, "test"]],
  [fn (Where $where) => $where->where(true), "?", [true]],
]);

test("implicit operator or where", function ($input, $output, $bindings = [], $column = "c1")
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c0")
    ->orWhere($column, $input)
  )
  ->toBe("SELECT * WHERE \"c0\" OR $output");

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

test("explicit expression or where", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c0")
    ->orWhere("c1", $operator, $input)
  )
  ->toBe("SELECT * WHERE \"c0\" OR \"c1\" $operator $output");

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

test("single expression where not", function ($input, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->whereNot($input))
  ->toBe("SELECT * WHERE NOT $output");

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
  [["c1" => 1, "c2" => "test"], '"c1" = ? AND NOT "c2" = ?', [1, "test"]],
  [fn (Where $where) => $where->where(true), "?", [true]],
]);

test("implicit operator where not", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->whereNot($column, $input))
  ->toBe("SELECT * WHERE NOT $output");

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

test("explicit expression where not", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->whereNot("c1", $operator, $input))
  ->toBe("SELECT * WHERE NOT \"c1\" $operator $output");

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

test("single expression or where not", function ($input, $output, $bindings = [])
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c0")
    ->orWhereNot($input)
  )
  ->toBe("SELECT * WHERE \"c0\" OR NOT $output");

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
  [["c1" => 1, "c2" => "test"], '"c1" = ? OR NOT "c2" = ?', [1, "test"]],
  [fn (Where $where) => $where->where(true), "?", [true]],
]);

test("implicit operator or where not", function ($input, $output, $bindings = [], $column = "c1")
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c0")
    ->orWhereNot($column, $input)
  )
  ->toBe("SELECT * WHERE \"c0\" OR NOT $output");

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

test("explicit expression or where not", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c0")
    ->orWhereNot("c1", $operator, $input)
  )
  ->toBe("SELECT * WHERE \"c0\" OR NOT \"c1\" $operator $output");

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

test("where between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->whereBetween($column, $value1, $value2))
  ->toBe("SELECT * WHERE $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test1", "test2", '"c1" BETWEEN ? AND ?', ["test1", "test2"]],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("or where between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c0")
    ->orWhereBetween($column, $value1, $value2)
  )
  ->toBe("SELECT * WHERE \"c0\" OR $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test1", "test2", '"c1" BETWEEN ? AND ?', ["test1", "test2"]],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("where not between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->whereNotBetween($column, $value1, $value2))
  ->toBe("SELECT * WHERE NOT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test1", "test2", '"c1" BETWEEN ? AND ?', ["test1", "test2"]],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("or where not between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c0")
    ->orWhereNotBetween($column, $value1, $value2)
  )
  ->toBe("SELECT * WHERE \"c0\" OR NOT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test1", "test2", '"c1" BETWEEN ? AND ?', ["test1", "test2"]],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("where raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->whereRaw("?", $bindings))
  ->toBe("SELECT * WHERE ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("or where raw", function ($bindings)
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c1")
    ->orWhereRaw("?", $bindings)
  )
  ->toBe("SELECT * WHERE \"c1\" OR ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("where not raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->whereNotRaw("?", $bindings))
  ->toBe("SELECT * WHERE NOT ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("or where not raw", function ($bindings)
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->where("c1")
    ->orWhereNotRaw("?", $bindings)
  )
  ->toBe("SELECT * WHERE \"c1\" OR NOT ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);