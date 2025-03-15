<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("rows examined", function ($row_count, $output, $bindings = [])
{

  expect((string) $stmt = SQL::MariaDB->select()->rowsExamined($row_count))
  ->toBe("SELECT * LIMIT ROWS EXAMINED $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  [1, "1"],
  ["test", "test"],
  [new Raw("?", 1), "?", [1]],
]);

test("rows examined with limit", function ()
{

  expect(
    (string) SQL::MariaDB->select()
    ->limit(5)
    ->rowsExamined(10)
  )
  ->toBe("SELECT * LIMIT 5 ROWS EXAMINED 10");

});