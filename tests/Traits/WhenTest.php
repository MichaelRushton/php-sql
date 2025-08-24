<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("when if true", function () {

    expect(
        (string) (new Select(SQL::SQLite))
    ->when(1, fn ($condition) => $this->where($condition), function ($condition, Select $stmt) {
        $stmt->whereNot($condition);
    })
    )
    ->toBe("SELECT * WHERE 1");

});

test("when if false", function () {

    expect(
        (string) (new Select(SQL::SQLite))
    ->when(0, fn ($condition) => $this->where($condition), function ($condition, Select $stmt) {
        $stmt->whereNot($condition);
    })
    )
    ->toBe("SELECT * WHERE NOT 0");

});
