<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("offset fetch", function ($offset, $row_count, $output, $bindings = [])
{

  expect((string) $stmt = SQL::TransactSQL->select()->offsetFetch($offset, $row_count))
  ->toBe("SELECT * OFFSET $output ROWS ONLY");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  [1, 2, "1 ROWS FETCH NEXT 2"],
  ["test1", "test2", "test1 ROWS FETCH NEXT test2"],
  [new Raw("?", 1), new Raw("?", 2), "? ROWS FETCH NEXT ?", [1, 2]],
]);

test("with ties", function ($sql)
{

  expect(
    (string) $sql->select()
    ->offsetFetch(1, 2)
    ->withTies()
  )
  ->toBe("SELECT * OFFSET 1 ROWS FETCH NEXT 2 ROWS WITH TIES");

})
->with([
  SQL::MariaDB,
  SQL::PostgreSQL,
]);

test("limit", function ()
{

  expect((string) SQL::TransactSQL->select()->limit(2, 1))
  ->toBe("SELECT * OFFSET 1 ROWS FETCH NEXT 2 ROWS ONLY");

});