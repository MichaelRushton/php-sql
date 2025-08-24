<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Delete;

test("table", function ($table, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Delete(SQL::MariaDB))
    ->using($table)
    )
    ->toBe("DELETE USING $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["t1", "t1"],
  [new Raw("?", 1), "?", [1]],
  [["t1", "t2"], "t1, t2"],
]);
