<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("from", function ($table, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->from($table)
    )
    ->toBe("SELECT * FROM $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["t1", "t1"],
  [new Raw("?", 1), "?", [1]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["t1", "t2"], "t1, t2"],
  [["a" => "t1", "b" => "t2"], "t1 a, t2 b"],
]);
