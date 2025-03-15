<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("cycle restrict", function ($column, $output)
{

  expect((string) SQL::MariaDB->cte("cte", SQL::MariaDB->select())->cycleRestrict($column))
  ->toBe("`cte` AS (SELECT *) CYCLE $output RESTRICT");

})
->with([
  ["c1", "`c1`"],
  [["c1", "c2"], "`c1`, `c2`"],
]);