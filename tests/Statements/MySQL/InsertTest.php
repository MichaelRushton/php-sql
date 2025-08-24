<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("insert", function () {

    expect(
        (string) $stmt = (new Insert(SQL::MySQL))
    ->lowPriority()
    ->highPriority()
    ->ignore()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->set("c1", 1)
    ->select("SELECT")
    ->as("new")
    ->onDuplicateKeyUpdate("c1", 1)
    )
    ->toBe(
        implode(" ", [
        "INSERT",
        "LOW_PRIORITY",
        "HIGH_PRIORITY",
        "IGNORE",
        "INTO t1",
        "(c1)",
        "VALUES (?)",
        "SET c1 = ?",
        "SELECT",
        "AS new",
        "ON DUPLICATE KEY UPDATE c1 = ?",
    ])
    );

    expect($stmt->bindings())
    ->toBe([1, 1, 1]);

});
