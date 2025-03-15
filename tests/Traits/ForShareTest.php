<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("for share", function ($table, $output)
{

  expect((string) SQL::MySQL->select()->forShare($table))
  ->toBe("SELECT * FOR SHARE$output");

})
->with([
  [null, ""],
  ["t1", " OF `t1`"],
  [["t1", "t2"], " OF `t1`, `t2`"],
]);

test("for share nowait", function ($table, $output)
{

  expect((string) SQL::MySQL->select()->forShareNoWait($table))
  ->toBe("SELECT * FOR SHARE$output NOWAIT");

})
->with([
  [null, ""],
  ["t1", " OF `t1`"],
  [["t1", "t2"], " OF `t1`, `t2`"],
]);

test("for share skip locked", function ($table, $output)
{

  expect((string) SQL::MySQL->select()->forShareSkipLocked($table))
  ->toBe("SELECT * FOR SHARE$output SKIP LOCKED");

})
->with([
  [null, ""],
  ["t1", " OF `t1`"],
  [["t1", "t2"], " OF `t1`, `t2`"],
]);