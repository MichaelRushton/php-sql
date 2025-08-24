<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("insert", function () {

    expect(
        (string) $stmt = (new Insert(SQL::SQLite))
    ->with("cte", "SELECT")
    ->orFail()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->select("SELECT")
    ->onConflictDoNothing()
    ->returning()
    )
    ->toBe(
        implode(" ", [
        "WITH cte AS (SELECT)",
        "INSERT",
        "OR FAIL",
        "INTO t1",
        "(c1)",
        "VALUES (?)",
        "SELECT",
        "ON CONFLICT DO NOTHING",
        "RETURNING *",
    ])
    );

    expect($stmt->bindings())
    ->toBe([1]);

});
