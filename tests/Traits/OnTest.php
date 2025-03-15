<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Join;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("single expression on", function ($input, $output, $bindings = [])
{

  expect((string) $stmt = (new Join(SQL::SQLite))->on($input))
  ->toBe("$output");

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
  [["c1" => "c2", "c3" => "c4"], '("c1" = "c2" AND "c3" = "c4")'],
  [fn (Join $on) => $on->on(true), "?", [true]],
]);

test("implicit operator on", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = (new Join(SQL::SQLite))->on($column, $input))
  ->toBe("$output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("explicit expression on", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = (new Join(SQL::SQLite))->on("c1", $operator, $input))
  ->toBe("\"c1\" $operator $output");

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
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("single expression or on", function ($input, $output, $bindings = [])
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c0")
    ->orOn($input)
  )
  ->toBe("(\"c0\" OR $output)");

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
  [["c1" => "c2", "c3" => "c4"], '"c1" = "c2" OR "c3" = "c4"'],
  [fn (Join $on) => $on->on(true), "?", [true]],
]);

test("implicit operator or on", function ($input, $output, $bindings = [], $column = "c1")
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c0")
    ->orOn($column, $input)
  )
  ->toBe("(\"c0\" OR $output)");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("explicit expression or on", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c0")
    ->orOn("c1", $operator, $input)
  )
  ->toBe("(\"c0\" OR \"c1\" $operator $output)");

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
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("single expression on not", function ($input, $output, $bindings = [])
{

  expect((string) $stmt = (new Join(SQL::SQLite))->onNot($input))
  ->toBe("$output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", 'NOT "c1"'],
  [new Raw("?", 1), "NOT ?", [1]],
  [1, "NOT ?", [1]],
  [1.1, "NOT ?", [1.1]],
  [true, "NOT ?", [true]],
  [null, "NOT NULL"],
  [["c1" => "c2", "c3" => "c4"], '(NOT "c1" = "c2" AND NOT "c3" = "c4")'],
  [fn (Join $on) => $on->on(true), "NOT ?", [true]],
]);

test("implicit operator on not", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = (new Join(SQL::SQLite))->onNot($column, $input))
  ->toBe("NOT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("explicit expression on not", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = (new Join(SQL::SQLite))->onNot("c1", $operator, $input))
  ->toBe("NOT \"c1\" $operator $output");

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
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("single expression or on not", function ($input, $output, $bindings = [])
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c0")
    ->orOnNot($input)
  )
  ->toBe("(\"c0\" OR NOT $output)");

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
  [["c1" => "c2", "c3" => "c4"], '"c1" = "c2" OR NOT "c3" = "c4"'],
  [fn (Join $on) => $on->on(true), "?", [true]],
]);

test("implicit operator or on not", function ($input, $output, $bindings = [], $column = "c1")
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c0")
    ->orOnNot($column, $input)
  )
  ->toBe("(\"c0\" OR NOT $output)");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", '"c1" = "c2"'],
  [new Raw("?", 1), '"c1" = ?', [1]],
  [1, '"c1" = ?', [1]],
  [1.1, '"c1" = ?', [1.1]],
  [true, '"c1" = ?', [true]],
  [null, '"c1" IS NULL'],
  [["c2", "c3"], '"c1" IN ("c2", "c3")'],
  [["c3", "c4"], '("c1", "c2") = ("c3", "c4")', [], ["c1", "c2"]],
]);

test("explicit expression or on not", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c0")
    ->orOnNot("c1", $operator, $input)
  )
  ->toBe("(\"c0\" OR NOT \"c1\" $operator $output)");

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
  [["c2", "c3"], '("c2", "c3")'],
  [["c2", "c3"], '"c2" AND "c3"', [], "BETWEEN"],
]);

test("on between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect((string) $stmt = (new Join(SQL::SQLite))->onBetween($column, $value1, $value2))
  ->toBe("$output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c2", "c3", '"c1" BETWEEN "c2" AND "c3"'],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("or on between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c0")
    ->orOnBetween($column, $value1, $value2)
  )
  ->toBe("(\"c0\" OR $output)");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c2", "c3", '"c1" BETWEEN "c2" AND "c3"'],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("on not between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect((string) $stmt = (new Join(SQL::SQLite))->onNotBetween($column, $value1, $value2))
  ->toBe("NOT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c2", "c3", '"c1" BETWEEN "c2" AND "c3"'],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("or on not between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c0")
    ->orOnNotBetween($column, $value1, $value2)
  )
  ->toBe("(\"c0\" OR NOT $output)");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c2", "c3", '"c1" BETWEEN "c2" AND "c3"'],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("on raw", function ($bindings)
{

  expect((string) $stmt = (new Join(SQL::SQLite))->onRaw("?", $bindings))
  ->toBe("?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("or on raw", function ($bindings)
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c1")
    ->orOnRaw("?", $bindings)
  )
  ->toBe("(\"c1\" OR ?)");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("on not raw", function ($bindings)
{

  expect((string) $stmt = (new Join(SQL::SQLite))->onNotRaw("?", $bindings))
  ->toBe("NOT ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("or on not raw", function ($bindings)
{

  expect(
    (string) $stmt = (new Join(SQL::SQLite))
    ->on("c1")
    ->orOnNotRaw("?", $bindings)
  )
  ->toBe("(\"c1\" OR NOT ?)");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);