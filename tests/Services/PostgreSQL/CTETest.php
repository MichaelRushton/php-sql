<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\PostgreSQL\CTE;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\PostgreSQL\Select;

test("cte", function ($stmt)
{

  expect(
    (string) (new CTE("cte", $stmt))
    ->columns("c1")
    ->materialized()
    ->searchBreadth("c1", "c1")
    ->cycle("c1")
  )
  ->toBe(implode(" ", [
    '"cte"',
    '("c1")',
    "AS",
    "MATERIALIZED",
    '(SELECT "c1")',
    'SEARCH BREADTH FIRST BY "c1" SET "c1"',
    'CYCLE "c1" SET "is_cycle" USING "path"',
  ]));

})
->with([
  ['SELECT "c1"'],
  [SQL::PostgreSQL->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);