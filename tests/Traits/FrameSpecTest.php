<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\Window;
use MichaelRushton\SQL\SQL;

test("range", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->range())
  ->toBe('"w" AS (RANGE)');

});

test("rows", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->rows())
  ->toBe('"w" AS (ROWS)');

});

test("groups", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->groups())
  ->toBe('"w" AS (GROUPS)');

});

test("current row", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->currentRow())
  ->toBe('"w" AS (CURRENT ROW)');

});

test("unbounded preceding", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->unboundedPreceding())
  ->toBe('"w" AS (UNBOUNDED PRECEDING)');

});

test("unbounded following", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->unboundedFollowing())
  ->toBe('"w" AS (UNBOUNDED FOLLOWING)');

});

test("preceding", function ($expression, $output, $bindings = [])
{

  expect((string) $window = (new Window(SQL::SQLite, "w"))->preceding($expression))
  ->toBe("\"w\" AS ($output PRECEDING)");

  expect($window->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("following", function ($expression, $output, $bindings = [])
{

  expect((string) $window = (new Window(SQL::SQLite, "w"))->following($expression))
  ->toBe("\"w\" AS ($output FOLLOWING)");

  expect($window->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("between current row", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->betweenCurrentRow())
  ->toBe('"w" AS (BETWEEN CURRENT ROW)');

});

test("between unbounded preceding", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->betweenUnboundedPreceding())
  ->toBe('"w" AS (BETWEEN UNBOUNDED PRECEDING)');

});

test("between unbounded following", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->betweenUnboundedFollowing())
  ->toBe('"w" AS (BETWEEN UNBOUNDED FOLLOWING)');

});

test("between preceding", function ($expression, $output, $bindings = [])
{

  expect((string) $window = (new Window(SQL::SQLite, "w"))->betweenPreceding($expression))
  ->toBe("\"w\" AS (BETWEEN $output PRECEDING)");

  expect($window->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("between following", function ($expression, $output, $bindings = [])
{

  expect((string) $window = (new Window(SQL::SQLite, "w"))->betweenFollowing($expression))
  ->toBe("\"w\" AS (BETWEEN $output FOLLOWING)");

  expect($window->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("and current row", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->andCurrentRow())
  ->toBe('"w" AS (AND CURRENT ROW)');

});

test("and unbounded preceding", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->andUnboundedPreceding())
  ->toBe('"w" AS (AND UNBOUNDED PRECEDING)');

});

test("and unbounded following", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->andUnboundedFollowing())
  ->toBe('"w" AS (AND UNBOUNDED FOLLOWING)');

});

test("and preceding", function ($expression, $output, $bindings = [])
{

  expect((string) $window = (new Window(SQL::SQLite, "w"))->andPreceding($expression))
  ->toBe("\"w\" AS (AND $output PRECEDING)");

  expect($window->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("and following", function ($expression, $output, $bindings = [])
{

  expect((string) $window = (new Window(SQL::SQLite, "w"))->andFollowing($expression))
  ->toBe("\"w\" AS (AND $output FOLLOWING)");

  expect($window->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("exclude current row", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->excludeCurrentRow())
  ->toBe('"w" AS (EXCLUDE CURRENT ROW)');

});

test("exclude group", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->excludeGroup())
  ->toBe('"w" AS (EXCLUDE GROUP)');

});

test("exclude no others", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->excludeNoOthers())
  ->toBe('"w" AS (EXCLUDE NO OTHERS)');

});

test("exclude ties", function ()
{

  expect((string) (new Window(SQL::SQLite, "w"))->excludeTies())
  ->toBe('"w" AS (EXCLUDE TIES)');

});

test("frame spec", function ()
{

  expect(
    (string) (new Window(SQL::SQLite, "w"))
    ->range()
    ->betweenCurrentRow()
    ->andCurrentRow()
    ->excludeCurrentRow()
  )
  ->toBe('"w" AS (RANGE BETWEEN CURRENT ROW AND CURRENT ROW EXCLUDE CURRENT ROW)');

});