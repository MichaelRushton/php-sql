<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("columns", function ($columns, $expected)
{

  expect(
    (string) (new Insert(SQL::SQLite))
    ->columns($columns)
  )
  ->toBe("INSERT ($expected) DEFAULT VALUES");

})
->with([
  ["c1", "c1"],
  [["c1", "c2"], "c1, c2"],
]);