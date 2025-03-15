<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\PostgreSQL\Table;

test("table", function ()
{

  expect(
    (string) (new Table("t1"))
    ->only()
    ->as("t2")
  )
  ->toBe(implode(" ", [
    "ONLY",
    '"t1"',
    'AS "t2"',
  ]));

});