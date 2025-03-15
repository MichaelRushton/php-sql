<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Having;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("single expression having", function ($input, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->having($input))
  ->toBe("SELECT * HAVING $output");

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
  [fn (Having $having) => $having->having(true), "?", [true]],
]);

test("implicit operator having", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->having($column, $input))
  ->toBe("SELECT * HAVING $output");

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

test("explicit expression having", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->having("c1", $operator, $input))
  ->toBe("SELECT * HAVING \"c1\" $operator $output");

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

test("single expression or having", function ($input, $output, $bindings = [])
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c0")
    ->orHaving($input)
  )
  ->toBe("SELECT * HAVING \"c0\" OR $output");

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
  [fn (Having $having) => $having->having(true), "?", [true]],
]);

test("implicit operator or having", function ($input, $output, $bindings = [], $column = "c1")
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c0")
    ->orHaving($column, $input)
  )
  ->toBe("SELECT * HAVING \"c0\" OR $output");

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

test("explicit expression or having", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c0")
    ->orHaving("c1", $operator, $input)
  )
  ->toBe("SELECT * HAVING \"c0\" OR \"c1\" $operator $output");

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

test("single expression having not", function ($input, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->havingNot($input))
  ->toBe("SELECT * HAVING NOT $output");

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
  [fn (Having $having) => $having->having(true), "?", [true]],
]);

test("implicit operator having not", function ($input, $output, $bindings = [], $column = "c1")
{

  expect((string) $stmt = SQL::SQLite->select()->havingNot($column, $input))
  ->toBe("SELECT * HAVING NOT $output");

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

test("explicit expression having not", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect((string) $stmt = SQL::SQLite->select()->havingNot("c1", $operator, $input))
  ->toBe("SELECT * HAVING NOT \"c1\" $operator $output");

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

test("single expression or having not", function ($input, $output, $bindings = [])
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c0")
    ->orHavingNot($input)
  )
  ->toBe("SELECT * HAVING \"c0\" OR NOT $output");

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
  [fn (Having $having) => $having->having(true), "?", [true]],
]);

test("implicit operator or having not", function ($input, $output, $bindings = [], $column = "c1")
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c0")
    ->orHavingNot($column, $input)
  )
  ->toBe("SELECT * HAVING \"c0\" OR NOT $output");

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

test("explicit expression or having not", function ($input, $output, $bindings = [], $operator = "!=")
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c0")
    ->orHavingNot("c1", $operator, $input)
  )
  ->toBe("SELECT * HAVING \"c0\" OR NOT \"c1\" $operator $output");

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

test("having between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->havingBetween($column, $value1, $value2))
  ->toBe("SELECT * HAVING $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test1", "test2", '"c1" BETWEEN ? AND ?', ["test1", "test2"]],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("or having between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c0")
    ->orHavingBetween($column, $value1, $value2)
  )
  ->toBe("SELECT * HAVING \"c0\" OR $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test1", "test2", '"c1" BETWEEN ? AND ?', ["test1", "test2"]],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("having not between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->select()->havingNotBetween($column, $value1, $value2))
  ->toBe("SELECT * HAVING NOT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test1", "test2", '"c1" BETWEEN ? AND ?', ["test1", "test2"]],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("or having not between", function ($column, $value1, $value2, $output, $bindings = [])
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c0")
    ->orHavingNotBetween($column, $value1, $value2)
  )
  ->toBe("SELECT * HAVING \"c0\" OR NOT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test1", "test2", '"c1" BETWEEN ? AND ?', ["test1", "test2"]],
  [new Raw("?", 1), new Raw("?", 2), new Raw("?", 3), "? BETWEEN ? AND ?", [1, 2, 3]],
  [1, 2, 3, "? BETWEEN ? AND ?", [1, 2, 3]],
  [1.1, 2.2, 3.3, "? BETWEEN ? AND ?", [1.1, 2.2, 3.3]],
]);

test("having raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->havingRaw("?", $bindings))
  ->toBe("SELECT * HAVING ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("or having raw", function ($bindings)
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c1")
    ->orHavingRaw("?", $bindings)
  )
  ->toBe("SELECT * HAVING \"c1\" OR ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("having not raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->select()->havingNotRaw("?", $bindings))
  ->toBe("SELECT * HAVING NOT ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);

test("or having not raw", function ($bindings)
{

  expect(
    (string) $stmt = SQL::SQLite->select()
    ->having("c1")
    ->orHavingNotRaw("?", $bindings)
  )
  ->toBe("SELECT * HAVING \"c1\" OR NOT ?");

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);