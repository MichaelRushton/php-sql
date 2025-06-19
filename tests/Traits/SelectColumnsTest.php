<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("columns", function ($columns, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->columns($columns)
  )
  ->toBe("SELECT $expected");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [new Raw("?", 1), "?", [1]],
  [["c1", "c2"], "c1, c2"],
]);