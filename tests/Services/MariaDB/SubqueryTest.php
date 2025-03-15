<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\MariaDB\Subquery;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\MariaDB\Select;

test("subquery", function ($stmt)
{

  expect(
    (string) (new Subquery($stmt))
    ->all()
    ->any()
    ->exists()
    ->in()
    ->forSystemTimeAll()
    ->as("s")
    ->columns("c1")
  )
  ->toBe(implode(" ", [
    "ALL",
    "ANY",
    "EXISTS",
    "IN",
    "(SELECT `c1`)",
    "FOR SYSTEM_TIME ALL",
    "AS `s`",
    "(`c1`)",
  ]));

})
->with([
  ["SELECT `c1`"],
  [SQL::MariaDB->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);