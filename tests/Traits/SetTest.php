<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Update;

test("set", function ($column, $value, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Update(SQL::SQLite))
    ->set($column, $value)
    )
    ->toBe("UPDATE SET $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  ["c1", "test", "c1 = ?", ["test"]],
  ["c1", 1, "c1 = ?", [1]],
  ["c1", 1.1, "c1 = ?", [1.1]],
  ["c1", true, "c1 = ?", [true]],
  ["c1", null, "c1 = ?", [null]],
  ["c1", new Raw("?", 1), "c1 = ?", [1]],
  [["c1" => "test", "c2" => 1], null, "c1 = ?, c2 = ?", ["test", 1]],
]);
