<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("limit", function ($sql, $row_count, $output, $bindings = [])
{

  expect((string) $stmt = $sql->select()->limit($row_count))
  ->toBe("SELECT * LIMIT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  SQL::MariaDB,
  SQL::MySQL,
  SQL::PostgreSQL,
  SQL::SQLite,
])
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("limit with offset", function ($sql, $offset, $output, $bindings = [])
{

  expect((string) $stmt = $sql->select()->limit(1, $offset))
  ->toBe("SELECT * LIMIT 1 OFFSET $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  SQL::MariaDB,
  SQL::MySQL,
  SQL::PostgreSQL,
  SQL::SQLite,
])
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("offset fetch", function ($sql, $row_count, $offset, $output, $bindings = [])
{

  expect((string) $stmt = $sql->select()->offsetFetch($offset, $row_count))
  ->toBe("SELECT * LIMIT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  SQL::MariaDB,
  SQL::MySQL,
  SQL::PostgreSQL,
  SQL::SQLite,
])
->with([
  [1, 2, "1 OFFSET 2"],
  ["test1", "test2", "test1 OFFSET test2"],
  [new Raw("?", 1), new Raw("?", 2), "? OFFSET ?", [1, 2]],
]);