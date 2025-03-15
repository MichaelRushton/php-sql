<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\SQLite\Subquery;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\SQLite\Select;

test("subquery", function ($stmt)
{

  expect(
    (string) (new Subquery($stmt))
    ->exists()
    ->in()
    ->as("s")
  )
  ->toBe(implode(" ", [
    "EXISTS",
    "IN",
    '(SELECT "c1")',
    'AS "s"',
  ]));

})
->with([
  ['SELECT "c1"'],
  [SQL::SQLite->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);