<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("columns", function ($column, $output)
{

  expect((string) SQL::SQLite->insert()->columns($column))
  ->toBe("INSERT ($output) DEFAULT VALUES");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);