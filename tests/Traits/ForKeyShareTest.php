<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("for key share", function ($table, $expected)
{

  expect(
    (string) (new Select(SQL::PostgreSQL))
    ->forKeyShare($table)
  )
  ->toBe("SELECT * FOR KEY SHARE$expected");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);

test("for key share nowait", function ($table, $expected)
{

  expect(
    (string) (new Select(SQL::PostgreSQL))
    ->forKeyShareNoWait($table)
  )
  ->toBe("SELECT * FOR KEY SHARE$expected NOWAIT");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);

test("for key share skip locked", function ($table, $expected)
{

  expect(
    (string) (new Select(SQL::PostgreSQL))
    ->forKeyShareSkipLocked($table)
  )
  ->toBe("SELECT * FOR KEY SHARE$expected SKIP LOCKED");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);