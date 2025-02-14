<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\PostgreSQL\Subquery;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

test("subquery", function ($stmt)
{

  expect(
    (string) (new Subquery($stmt))
    ->all()
    ->any()
    ->exists()
    ->in()
    ->lateral()
    ->as("s")
    ->columns("c1")
  )
  ->toBe(implode(" ", [
    "ALL",
    "ANY",
    "EXISTS",
    "IN",
    "LATERAL",
    '(SELECT "c1")',
    'AS "s"',
    '("c1")',
  ]));

})
->with([
  ['SELECT "c1"'],
  [SQL::PostgreSQL->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);