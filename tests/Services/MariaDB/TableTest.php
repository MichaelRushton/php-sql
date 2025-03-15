<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\MariaDB\Table;

test("table", function ()
{

  expect(
    (string) (new Table("t1"))
    ->partition("p1")
    ->forSystemTimeAll()
    ->forPortionOf("date_period", "2025-01-01", "2025-02-01")
    ->beforeSystemTimeRaw("TRANSACTION 1")
    ->as("t2")
    ->useIndex()
  )
  ->toBe(implode(" ", [
    "`t1`",
    "PARTITION (`p1`)",
    "FOR SYSTEM_TIME ALL",
    "FOR PORTION OF `date_period` FROM '2025-01-01' TO '2025-02-01'",
    "BEFORE SYSTEM_TIME TRANSACTION 1",
    "AS `t2`",
    "USE INDEX ()",
  ]));

});