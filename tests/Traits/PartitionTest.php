<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("partition", function ($partition, $output)
{

  expect((string) SQL::MariaDB->table("t1")->partition($partition))
  ->toBe("`t1` PARTITION ($output)");

})
->with([
  ["p1", "`p1`"],
  [["p1", "p2"], "`p1`, `p2`"],
]);