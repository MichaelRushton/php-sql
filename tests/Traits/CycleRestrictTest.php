<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\CTE;

test("cycle restrict", function ($columns, $expected)
{

  expect(
    (string) (new CTE("cte", "SELECT"))
    ->cycleRestrict($columns)
  )
  ->toBe("cte AS (SELECT) CYCLE $expected RESTRICT");

})
->with([
  ["c1", "c1"],
  [["c1", "c2"], "c1, c2"],
]);