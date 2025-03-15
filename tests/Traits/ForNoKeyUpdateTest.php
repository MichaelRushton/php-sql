<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("for no key update", function ($table, $output)
{

  expect((string) SQL::PostgreSQL->select()->forNoKeyUpdate($table))
  ->toBe("SELECT * FOR NO KEY UPDATE$output");

})
->with([
  [null, ""],
  ["t1", ' OF "t1"'],
  [["t1", "t2"], ' OF "t1", "t2"'],
]);

test("for no key update nowait", function ($table, $output)
{

  expect((string) SQL::PostgreSQL->select()->forNoKeyUpdateNoWait($table))
  ->toBe("SELECT * FOR NO KEY UPDATE$output NOWAIT");

})
->with([
  [null, ""],
  ["t1", ' OF "t1"'],
  [["t1", "t2"], ' OF "t1", "t2"'],
]);

test("for no key update skip locked", function ($table, $output)
{

  expect((string) SQL::PostgreSQL->select()->forNoKeyUpdateSkipLocked($table))
  ->toBe("SELECT * FOR NO KEY UPDATE$output SKIP LOCKED");

})
->with([
  [null, ""],
  ["t1", ' OF "t1"'],
  [["t1", "t2"], ' OF "t1", "t2"'],
]);