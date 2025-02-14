<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\SQLite\Table;

test("table", function ()
{

  expect(
    (string) (new Table("t1"))
    ->as("t2")
  )
  ->toBe(implode(" ", [
    '"t1"',
    'AS "t2"',
  ]));

});