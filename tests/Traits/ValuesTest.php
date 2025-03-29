<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("empty values", function ($sql, $expected)
{

  expect(
    (string) (new Insert($sql))
    ->values([])
  )
  ->toBe("INSERT $expected");

})
->with([
  [SQL::MariaDB, "VALUES ()"],
  [SQL::MySQL, "VALUES ()"],
  [SQL::PostgreSQL, "DEFAULT VALUES"],
  [SQL::SQLite, "DEFAULT VALUES"],
  [SQL::TransactSQL, "DEFAULT VALUES"],
]);

test("values", function ($values, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Insert(SQL::SQLite))
    ->values($values)
  )
  ->toBe("INSERT VALUES ($expected)");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  [["test", 1, 1.1, true, null, new Raw("?", 1)], "?, ?, ?, ?, ?, ?", ["test", 1, 1.1, true, null, 1]],
  [[["test"], [1]], "?), (?", ["test", 1]],
]);