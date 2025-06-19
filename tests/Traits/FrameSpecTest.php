<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\Components\Window;

test("range", function ()
{

  expect(
    (string) (new Window("w"))
    ->range()
  )
  ->toBe("w AS (RANGE)");

});

test("rows", function ()
{

  expect(
    (string) (new Window("w"))
    ->rows()
  )
  ->toBe("w AS (ROWS)");

});

test("groups", function ()
{

  expect(
    (string) (new Window("w"))
    ->groups()
  )
  ->toBe("w AS (GROUPS)");

});

test("current row", function ()
{

  expect(
    (string) (new Window("w"))
    ->currentRow()
  )
  ->toBe("w AS (CURRENT ROW)");

});

test("unbounded preceding", function ()
{

  expect(
    (string) (new Window("w"))
    ->unboundedPreceding()
  )
  ->toBe("w AS (UNBOUNDED PRECEDING)");

});

test("unbounded following", function ()
{

  expect(
    (string) (new Window("w"))
    ->unboundedFollowing()
  )
  ->toBe("w AS (UNBOUNDED FOLLOWING)");

});

test("preceding", function ($expression, $expected, $bindings = [])
{

  expect(
    (string) $window = (new Window("w"))
    ->preceding($expression)
  )
  ->toBe("w AS ($expected PRECEDING)");

  expect($window->bindings()
  )
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("following", function ($expression, $expected, $bindings = [])
{

  expect(
    (string) $window = (new Window("w"))
    ->following($expression)
  )
  ->toBe("w AS ($expected FOLLOWING)");

  expect($window->bindings()
  )
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("between current row", function ()
{

  expect(
    (string) (new Window("w"))
    ->betweenCurrentRow()
  )
  ->toBe("w AS (BETWEEN CURRENT ROW)");

});

test("between unbounded preceding", function ()
{

  expect(
    (string) (new Window("w"))
    ->betweenUnboundedPreceding()
  )
  ->toBe("w AS (BETWEEN UNBOUNDED PRECEDING)");

});

test("between unbounded following", function ()
{

  expect(
    (string) (new Window("w"))
    ->betweenUnboundedFollowing()
  )
  ->toBe("w AS (BETWEEN UNBOUNDED FOLLOWING)");

});

test("between preceding", function ($expression, $expected, $bindings = [])
{

  expect(
    (string) $window = (new Window("w"))
    ->betweenPreceding($expression)
  )
  ->toBe("w AS (BETWEEN $expected PRECEDING)");

  expect($window->bindings()
  )
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("between following", function ($expression, $expected, $bindings = [])
{

  expect(
    (string) $window = (new Window("w"))
    ->betweenFollowing($expression)
  )
  ->toBe("w AS (BETWEEN $expected FOLLOWING)");

  expect($window->bindings()
  )
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("and current row", function ()
{

  expect(
    (string) (new Window("w"))
    ->andCurrentRow()
  )
  ->toBe("w AS (AND CURRENT ROW)");

});

test("and unbounded preceding", function ()
{

  expect(
    (string) (new Window("w"))
    ->andUnboundedPreceding()
  )
  ->toBe("w AS (AND UNBOUNDED PRECEDING)");

});

test("and unbounded following", function ()
{

  expect(
    (string) (new Window("w"))
    ->andUnboundedFollowing()
  )
  ->toBe("w AS (AND UNBOUNDED FOLLOWING)");

});

test("and preceding", function ($expression, $expected, $bindings = [])
{

  expect(
    (string) $window = (new Window("w"))
    ->andPreceding($expression)
  )
  ->toBe("w AS (AND $expected PRECEDING)");

  expect($window->bindings()
  )
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("and following", function ($expression, $expected, $bindings = [])
{

  expect(
    (string) $window = (new Window("w"))
    ->andFollowing($expression)
  )
  ->toBe("w AS (AND $expected FOLLOWING)");

  expect($window->bindings()
  )
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("exclude current row", function ()
{

  expect(
    (string) (new Window("w"))
    ->excludeCurrentRow()
  )
  ->toBe("w AS (EXCLUDE CURRENT ROW)");

});

test("exclude group", function ()
{

  expect(
    (string) (new Window("w"))
    ->excludeGroup()
  )
  ->toBe("w AS (EXCLUDE GROUP)");

});

test("exclude no others", function ()
{

  expect(
    (string) (new Window("w"))
    ->excludeNoOthers()
  )
  ->toBe("w AS (EXCLUDE NO OTHERS)");

});

test("exclude ties", function ()
{

  expect(
    (string) (new Window("w"))
    ->excludeTies()
  )
  ->toBe("w AS (EXCLUDE TIES)");

});

test("frame spec", function ()
{

  expect(

    (string) (new Window("w"))
    ->range()
    ->betweenCurrentRow()
    ->andCurrentRow()
    ->excludeCurrentRow()
  )
  ->toBe("w AS (RANGE BETWEEN CURRENT ROW AND CURRENT ROW EXCLUDE CURRENT ROW)");

});