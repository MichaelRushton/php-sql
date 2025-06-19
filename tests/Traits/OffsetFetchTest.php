<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("offset fetch", function ($offset, $row_count, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::TransactSQL))
    ->offsetFetch($offset, $row_count)
  )
  ->toBe("SELECT * OFFSET $expected ONLY");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  [1, 2, "1 ROWS FETCH NEXT 2 ROWS"],
  ["test1", "test2", "test1 ROWS FETCH NEXT test2 ROWS"],
  [new Raw("?", 1), new Raw("?", 1), "? ROWS FETCH NEXT ? ROWS", [1, 1]],
]);

test("offset fetch with ties", function ()
{

  expect(
    (string) (new Select(SQL::MariaDB))
    ->offsetFetch(1, 2)
    ->withTies()
  )
  ->toBe("SELECT * OFFSET 1 ROWS FETCH NEXT 2 ROWS WITH TIES");

});