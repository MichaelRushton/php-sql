<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("for share", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forShare($table)
    )
    ->toBe("SELECT * FOR SHARE$expected");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);

test("for share nowait", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forShareNoWait($table)
    )
    ->toBe("SELECT * FOR SHARE$expected NOWAIT");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);

test("for share skip locked", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forShareSkipLocked($table)
    )
    ->toBe("SELECT * FOR SHARE$expected SKIP LOCKED");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);
