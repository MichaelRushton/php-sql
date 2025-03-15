<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\SQLite\CTE;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\SQLite\Select;

test("cte", function ($stmt)
{

  expect(
    (string) (new CTE("cte", $stmt))
    ->columns("c1")
    ->materialized()
  )
  ->toBe(implode(" ", [
    '"cte"',
    '("c1")',
    "AS",
    "MATERIALIZED",
    '(SELECT "c1")',
  ]));

})
->with([
  ['SELECT "c1"'],
  [SQL::SQLite->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);