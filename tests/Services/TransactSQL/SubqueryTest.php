<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\TransactSQL\Subquery;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\TransactSQL\Select;

test("subquery", function ($stmt)
{

  expect(
    (string) (new Subquery($stmt))
    ->all()
    ->any()
    ->exists()
    ->in()
    ->as("s")
    ->columns("c1")
  )
  ->toBe(implode(" ", [
    "ALL",
    "ANY",
    "EXISTS",
    "IN",
    "(SELECT [c1])",
    "AS [s]",
    "([c1])",
  ]));

})
->with([
  ["SELECT [c1]"],
  [SQL::TransactSQL->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);