<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\MySQL\Table;

test("table", function ()
{

  expect(
    (string) (new Table("t1"))
    ->partition("p1")
    ->as("t2")
    ->useIndex()
  )
  ->toBe(implode(" ", [
    "`t1`",
    "PARTITION (`p1`)",
    "AS `t2`",
    "USE INDEX ()",
  ]));

});