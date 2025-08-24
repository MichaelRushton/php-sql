<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("lock in share mode", function () {

    expect(
        (string) (new Select(SQL::MariaDB))
    ->lockInShareMode()
    )
    ->toBe("SELECT * LOCK IN SHARE MODE");

});

test("lock in share mode wait", function () {

    expect(
        (string) (new Select(SQL::MariaDB))
    ->lockInShareModeWait(1)
    )
    ->toBe("SELECT * LOCK IN SHARE MODE WAIT 1");

});

test("lock in share mode nowait", function () {

    expect(
        (string) (new Select(SQL::MariaDB))
    ->lockInShareModeNoWait()
    )
    ->toBe("SELECT * LOCK IN SHARE MODE NOWAIT");

});

test("lock in share mode skip locked", function () {

    expect(
        (string) (new Select(SQL::MariaDB))
    ->lockInShareModeSkipLocked()
    )
    ->toBe("SELECT * LOCK IN SHARE MODE SKIP LOCKED");

});
