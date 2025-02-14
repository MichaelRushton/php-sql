<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("for update", function ($table, $output)
{

  expect((string) SQL::MySQL->select()->forUpdate($table))
  ->toBe("SELECT * FOR UPDATE$output");

})
->with([
  [null, ""],
  ["t1", " OF `t1`"],
  [["t1", "t2"], " OF `t1`, `t2`"],
]);

test("for update wait", function ()
{

  expect((string) SQL::MySQL->select()->forUpdateWait(1))
  ->toBe("SELECT * FOR UPDATE WAIT 1");

});

test("for update nowait", function ($table, $output)
{

  expect((string) SQL::MySQL->select()->forUpdateNoWait($table))
  ->toBe("SELECT * FOR UPDATE$output NOWAIT");

})
->with([
  [null, ""],
  ["t1", " OF `t1`"],
  [["t1", "t2"], " OF `t1`, `t2`"],
]);

test("for update skip locked", function ($table, $output)
{

  expect((string) SQL::MySQL->select()->forUpdateSkipLocked($table))
  ->toBe("SELECT * FOR UPDATE$output SKIP LOCKED");

})
->with([
  [null, ""],
  ["t1", " OF `t1`"],
  [["t1", "t2"], " OF `t1`, `t2`"],
]);