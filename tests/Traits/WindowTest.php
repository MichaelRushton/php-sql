<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\Components\Window;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("windows", function () {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->window("w1", fn (Window $window) => $window->orderBy(new Raw("?", 1)))
    )
    ->toBe("SELECT * WINDOW w1 AS (ORDER BY ?)");

    expect($stmt->bindings())
    ->toBe([1]);

});

test("multiple windows", function () {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->window("w1", fn (Window $window) => $window->orderBy(new Raw("?", 1)))
    ->window("w2", fn (Window $window) => $window->orderBy(new Raw("?", 1)))
    )
    ->toBe("SELECT * WINDOW w1 AS (ORDER BY ?), w2 AS (ORDER BY ?)");

    expect($stmt->bindings())
    ->toBe([1, 1]);

});
