<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Select;

test("select", function ($stmt, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Insert(SQL::SQLite))
    ->select($stmt)
    )
    ->toBe("INSERT $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["SELECT", "SELECT"],
  [new Raw("SELECT ?", [1]), "SELECT ?", [1]],
  [fn (Select $stmt) => $stmt->where("c1", 1), "SELECT * WHERE c1 = ?", [1]],
]);
