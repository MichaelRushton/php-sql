<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("insert", function () {

    expect(
        (string) $stmt = (new Insert(SQL::MariaDB))
    ->lowPriority()
    ->delayed()
    ->highPriority()
    ->ignore()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->set("c1", 1)
    ->select("SELECT")
    ->onDuplicateKeyUpdate("c1", 1)
    ->returning()
    )
    ->toBe(
        implode(" ", [
        "INSERT",
        "LOW_PRIORITY",
        "DELAYED",
        "HIGH_PRIORITY",
        "IGNORE",
        "INTO t1",
        "(c1)",
        "VALUES (?)",
        "SET c1 = ?",
        "SELECT",
        "ON DUPLICATE KEY UPDATE c1 = ?",
        "RETURNING *",
    ])
    );

    expect($stmt->bindings())
    ->toBe([1, 1, 1]);

});
