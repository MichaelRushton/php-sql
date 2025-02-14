<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\MariaDB\CTE;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\MariaDB\Select;

test("cte", function ($stmt)
{

  expect(
    (string) (new CTE("cte", $stmt))
    ->columns("c1")
    ->cycleRestrict("c1")
  )
  ->toBe(implode(" ", [
    "`cte`",
    "(`c1`)",
    "AS",
    "(SELECT `c1`)",
    "CYCLE `c1` RESTRICT",
  ]));

})
->with([
  ["SELECT `c1`"],
  [SQL::MariaDB->select("c1")],
  [fn (Select $stmt) => $stmt->select("c1"), null],
]);