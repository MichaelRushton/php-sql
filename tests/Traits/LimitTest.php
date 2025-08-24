<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("limit", function ($row_count, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->limit($row_count)
    )
    ->toBe("SELECT * LIMIT $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("limit offset", function ($offset, $expected, $bindings = []) {

    expect(
        (string) $stmt = (new Select(SQL::SQLite))
    ->limit(1, $offset)
    )
    ->toBe("SELECT * LIMIT 1 OFFSET $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);
