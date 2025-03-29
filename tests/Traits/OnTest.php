<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\On;
use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("empty on", function ()
{

  expect((string) new On)
  ->toBe("");

});

test("on single column", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on($column)
  )
  ->toBe($expected);

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "c3", "c2" => "c4"], "(c1 = c3 AND c2 = c4)"],
]);

test("on implicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c1", $value)
  )
  ->toBe("c1 $expected");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", "= c2"],
  [1, "= 1"],
  [1.1, "= 1.1"],
  [true, "= ?", [true]],
  [["c2", 1], "= (c2, 1)"],
  [new Raw("?", "test"), "= ?", ["test"]],
  [new Select(SQL::SQLite), "= (SELECT *)"],
]);

test("on explicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c1", "!=", $value)
  )
  ->toBe("c1 != $expected");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", "c2"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [["c2", 1], "(c2, 1)"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("on callback", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on(function () use ($column)
    {
      $this->on($column);
    })
  )
  ->toBe($expected);

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "c3", "c2" => "c4"], "(c1 = c3 AND c2 = c4)"],
]);

test("or on single column", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOn($column)
  )
  ->toBe("(c0 OR $expected)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "c3", "c2" => "c4"], "c1 = c3 OR c2 = c4"],
]);

test("or on implicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOn("c1", $value)
  )
  ->toBe("(c0 OR c1 $expected)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", "= c2"],
  [1, "= 1"],
  [1.1, "= 1.1"],
  [true, "= ?", [true]],
  [["c2", 1], "= (c2, 1)"],
  [new Raw("?", "test"), "= ?", ["test"]],
  [new Select(SQL::SQLite), "= (SELECT *)"],
]);

test("or on explicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOn("c1", "!=", $value)
  )
  ->toBe("(c0 OR c1 != $expected)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", "c2"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [["c2", 1], "(c2, 1)"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("or on callback", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOn(function ($on) use ($column)
    {
      $on->on($column);
    })
  )
  ->toBe("(c0 OR $expected)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "c3", "c2" => "c4"], "(c1 = c3 AND c2 = c4)"],
]);

test("on not single column", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onNot($column)
  )
  ->toBe($expected);

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "NOT c1"],
  [1, "NOT 1"],
  [1.1, "NOT 1.1"],
  [true, "NOT ?", [true]],
  [new Raw("?", "test"), "NOT ?", ["test"]],
  [new Select(SQL::SQLite), "NOT (SELECT *)"],
  [["c1" => "c3", "c2" => "c4"], "(NOT c1 = c3 AND NOT c2 = c4)"],
]);

test("on not implicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onNot("c1", $value)
  )
  ->toBe("NOT c1 $expected");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", "= c2"],
  [1, "= 1"],
  [1.1, "= 1.1"],
  [true, "= ?", [true]],
  [["c1", 1], "= (c1, 1)"],
  [new Raw("?", "test"), "= ?", ["test"]],
  [new Select(SQL::SQLite), "= (SELECT *)"],
]);

test("on not explicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onNot("c1", "!=", $value)
  )
  ->toBe("NOT c1 != $expected");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", "c2"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [["c2", 1], "(c2, 1)"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("on not callback", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onNot(function () use ($column)
    {
      $this->on($column);
    })
  )
  ->toBe("NOT $expected");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "c3", "c2" => "c4"], "(c1 = c3 AND c2 = c4)"],
]);

test("or on not single column", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnNot($column)
  )
  ->toBe("(c0 OR NOT $expected)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "c3", "c2" => "c4"], "c1 = c3 OR NOT c2 = c4"],
]);

test("or on not implicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnNot("c1", $value)
  )
  ->toBe("(c0 OR NOT c1 $expected)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", "= c2"],
  [1, "= 1"],
  [1.1, "= 1.1"],
  [true, "= ?", [true]],
  [["c1", 1], "= (c1, 1)"],
  [new Raw("?", "test"), "= ?", ["test"]],
  [new Select(SQL::SQLite), "= (SELECT *)"],
]);

test("or on not explicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnNot("c1", "!=", $value)
  )
  ->toBe("(c0 OR NOT c1 != $expected)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c2", "c2"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [["c2", 1], "(c2, 1)"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("or on not callback", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnNot(function ($on) use ($column)
    {
      $on->on($column);
    })
  )
  ->toBe("(c0 OR NOT $expected)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "c3", "c2" => "c4"], "(c1 = c3 AND c2 = c4)"],
]);

test("on in", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onIn($column, ["c2", "c3"])
  )
  ->toBe("$expected IN (c2, c3)");

  expect($on->bindings())
  ->toBe(array_merge($bindings));

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("or on in", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnIn($column, ["c2", "c3"])
  )
  ->toBe("(c0 OR $expected IN (c2, c3))");

  expect($on->bindings())
  ->toBe(array_merge($bindings));

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("on not in", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onNotIn($column, ["c2", "c3"])
  )
  ->toBe("NOT $expected IN (c2, c3)");

  expect($on->bindings())
  ->toBe(array_merge($bindings));

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("or on not in", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnNotIn($column, ["c2", "c3"])
  )
  ->toBe("(c0 OR NOT $expected IN (c2, c3))");

  expect($on->bindings())
  ->toBe(array_merge($bindings));

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("on between", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onBetween($column, "c2", 1)
  )
  ->toBe("$expected BETWEEN c2 AND 1");

  expect($on->bindings())
  ->toBe(array_merge($bindings));

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("on not between", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onNotBetween($column, "c2", 1)
  )
  ->toBe("NOT $expected BETWEEN c2 AND 1");

  expect($on->bindings())
  ->toBe(array_merge($bindings));

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("or on between", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnBetween($column, "c2", 1)
  )
  ->toBe("(c0 OR $expected BETWEEN c2 AND 1)");

  expect($on->bindings())
  ->toBe(array_merge($bindings));

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("or on not between", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnNotBetween($column, "c2", 1)
  )
  ->toBe("(c0 OR NOT $expected BETWEEN c2 AND 1)");

  expect($on->bindings())
  ->toBe(array_merge($bindings));

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("on null", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onNull($column)
  )
  ->toBe("$expected IS NULL");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("or on null", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnNull($column)
  )
  ->toBe("(c0 OR $expected IS NULL)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("on not null", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->onNotNull($column)
  )
  ->toBe("NOT $expected IS NULL");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("or on not null", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($on = new On)
    ->on("c0")
    ->orOnNotNull($column)
  )
  ->toBe("(c0 OR NOT $expected IS NULL)");

  expect($on->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);