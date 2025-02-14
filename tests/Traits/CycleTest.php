<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("cycle", function ($column, $output)
{

  expect((string) SQL::PostgreSQL->cte("cte", "SELECT *")->cycle($column, "c3", "c4"))
  ->toBe("\"cte\" AS (SELECT *) CYCLE $output SET \"c3\" USING \"c4\"");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);