<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("overriding system value", function () {

    expect(
        (string) (new Insert(SQL::PostgreSQL))
    ->overridingSystemValue()
    )
    ->toBe("INSERT OVERRIDING SYSTEM VALUE DEFAULT VALUES");

});

test("overriding user value", function () {

    expect(
        (string) (new Insert(SQL::PostgreSQL))
    ->overridingUserValue()
    )
    ->toBe("INSERT OVERRIDING USER VALUE DEFAULT VALUES");

});
