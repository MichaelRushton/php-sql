<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("or fail", function () {

    expect(
        (string) (new Insert(SQL::SQLite))
    ->orFail()
    )
    ->toBe("INSERT OR FAIL DEFAULT VALUES");

});

test("or ignore", function () {

    expect(
        (string) (new Insert(SQL::SQLite))
    ->orIgnore()
    )
    ->toBe("INSERT OR IGNORE DEFAULT VALUES");

});

test("or replace", function () {

    expect(
        (string) (new Insert(SQL::SQLite))
    ->orReplace()
    )
    ->toBe("INSERT OR REPLACE DEFAULT VALUES");

});

test("or roll back", function () {

    expect(
        (string) (new Insert(SQL::SQLite))
    ->orRollBack()
    )
    ->toBe("INSERT OR ROLLBACK DEFAULT VALUES");

});
