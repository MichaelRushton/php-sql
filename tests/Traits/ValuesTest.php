<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("values", function ($values, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->insert()->values($values))
  ->toBe("INSERT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  [["test", new Raw("?", 1), 1, 1.1, true, null], "VALUES (?, ?, ?, ?, ?, NULL)", ["test", 1, 1, 1.1, true]],
  [[[1], [2]], "VALUES (?), (?)", [1, 2]],
  [["c1" => 1, "c2" => 2], '("c1", "c2") VALUES (?, ?)', [1, 2]],
  [[["c1" => 1], ["c2" => 2]], '("c1") VALUES (?), (?)', [1, 2]],
]);