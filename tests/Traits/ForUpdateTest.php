<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("for update", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forUpdate($table)
    )
    ->toBe("SELECT * FOR UPDATE$expected");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);

test("for update wait", function () {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forUpdateWait(1)
    )
    ->toBe("SELECT * FOR UPDATE WAIT 1");

});

test("for update nowait", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forUpdateNoWait($table)
    )
    ->toBe("SELECT * FOR UPDATE$expected NOWAIT");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);

test("for update skip locked", function ($table, $expected) {

    expect(
        (string) (new Select(SQL::PostgreSQL))
    ->forUpdateSkipLocked($table)
    )
    ->toBe("SELECT * FOR UPDATE$expected SKIP LOCKED");

})
->with([
  [null, ""],
  ["t1", " OF t1"],
  [["t1", "t2"], " OF t1, t2"],
]);
