<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\CTE;

test("cycle", function ($columns, $expected)
{

  expect(
    (string) (new CTE("cte", "SELECT"))
    ->cycle($columns, "a", "b")
  )
  ->toBe("cte AS (SELECT) CYCLE $expected SET a USING b");

})
->with([
  ["c1", "c1"],
  [["c1", "c2"], "c1, c2"],
]);