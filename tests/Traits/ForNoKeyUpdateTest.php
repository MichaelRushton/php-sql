<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("for no key update", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forNoKeyUpdate($table)
    )
    ->toBe("SELECT * FOR NO KEY UPDATE$expected");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);

test("for no key update nowait", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forNoKeyUpdateNoWait($table)
    )
    ->toBe("SELECT * FOR NO KEY UPDATE$expected NOWAIT");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);

test("for no key update skip locked", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forNoKeyUpdateSkipLocked($table)
    )
    ->toBe("SELECT * FOR NO KEY UPDATE$expected SKIP LOCKED");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);
