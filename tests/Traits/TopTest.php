<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("top", function ($row_count, $output, $bindings = [])
{

  expect((string) $stmt = SQL::TransactSQL->select()->top($row_count))
  ->toBe("SELECT TOP ($output) *");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  [1.1, "1.1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("percent", function ()
{

  expect(
    (string) SQL::TransactSQL->select()
    ->top(1)
    ->percent()
  )
  ->toBe("SELECT TOP (1) PERCENT *");

});

test("with ties", function ()
{

  expect(
    (string) SQL::TransactSQL->select()
    ->top(1)
    ->withTies()
  )
  ->toBe("SELECT TOP (1) WITH TIES *");

});

test("percent with ties", function ()
{

  expect(
    (string) SQL::TransactSQL->select()
    ->top(1)
    ->percent()
    ->withTies()
  )
  ->toBe("SELECT TOP (1) PERCENT WITH TIES *");

});

test("limit", function ()
{

  expect((string) SQL::TransactSQL->select()->limit(1))
  ->toBe("SELECT TOP (1) *");

});