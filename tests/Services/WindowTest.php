<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Window;
use MichaelRushton\SQL\SQL;

test("window", function ()
{

  expect(
    (string) (new Window(SQL::SQLite, "w1"))
    ->specName("w2")
    ->partitionBy("c1")
    ->orderBy("c1")
    ->range()
  )
  ->toBe(implode(" ", [
    '"w1"',
    "AS",
    '("w2"',
    'PARTITION BY "c1"',
    'ORDER BY "c1"',
    "RANGE)",
  ]));

});