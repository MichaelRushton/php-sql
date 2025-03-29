<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("row alias", function ($expected = "", ...$columns)
{

  expect(
    (string) (new Insert(SQL::MySQL))
    ->as("new", ...$columns)
  )
  ->toBe("INSERT VALUES () AS new$expected");

})
->with([
  [],
  [" (a)", "a"],
  [" (a, b)", ["a", "b"]],
]);