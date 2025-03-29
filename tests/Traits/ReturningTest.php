<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("returning", function ($columns, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Insert(SQL::MariaDB))
    ->returning($columns)
  )
  ->toBe("INSERT VALUES () RETURNING $expected");

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