<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update;

test("table", function ($table, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Update(SQL::SQLite))
    ->table($table)
    )
    ->toBe("UPDATE $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["t1", "t1"],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t2"], "t1, t2"],
]);
