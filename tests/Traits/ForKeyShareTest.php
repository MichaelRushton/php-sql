<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("for key share", function ($table, $output)
{

  expect((string) SQL::PostgreSQL->select()->forKeyShare($table))
  ->toBe("SELECT * FOR KEY SHARE$output");

})
->with([
  [null, ""],
  ["t1", ' OF "t1"'],
  [["t1", "t2"], ' OF "t1", "t2"'],
]);

test("for key share nowait", function ($table, $output)
{

  expect((string) SQL::PostgreSQL->select()->forKeyShareNoWait($table))
  ->toBe("SELECT * FOR KEY SHARE$output NOWAIT");

})
->with([
  [null, ""],
  ["t1", ' OF "t1"'],
  [["t1", "t2"], ' OF "t1", "t2"'],
]);

test("for key share skip locked", function ($table, $output)
{

  expect((string) SQL::PostgreSQL->select()->forKeyShareSkipLocked($table))
  ->toBe("SELECT * FOR KEY SHARE$output SKIP LOCKED");

})
->with([
  [null, ""],
  ["t1", ' OF "t1"'],
  [["t1", "t2"], ' OF "t1", "t2"'],
]);