<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\MySQL\CTE;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\MySQL\Select;

test("cte", function ($stmt)
{

  expect(
    (string) (new CTE("cte", $stmt))
    ->columns("c1")
  )
  ->toBe(implode(" ", [
    "`cte`",
    "(`c1`)",
    "AS",
    "(SELECT `c1`)",
  ]));

})
->with([
  ["SELECT `c1`"],
  [SQL::MySQL->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);