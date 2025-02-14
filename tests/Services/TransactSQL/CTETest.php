<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\TransactSQL\CTE;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\TransactSQL\Select;

test("cte", function ($stmt)
{

  expect(
    (string) (new CTE("cte", $stmt))
    ->columns("c1")
  )
  ->toBe(implode(" ", [
    "[cte]",
    "([c1])",
    "AS",
    "(SELECT [c1])",
  ]));

})
->with([
  ["SELECT [c1]"],
  [SQL::TransactSQL->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);