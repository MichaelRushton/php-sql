<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("top", function ($row_count, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::TransactSQL))
    ->top($row_count)
  )
  ->toBe("SELECT TOP ($expected) *");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  [1.1, "1.1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);