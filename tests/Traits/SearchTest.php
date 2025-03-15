<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("search breadth", function ($column, $output)
{

  expect((string) SQL::PostgreSQL->cte("cte", "SELECT *")->searchBreadth($column, "c1"))
  ->toBe("\"cte\" AS (SELECT *) SEARCH BREADTH FIRST BY $output SET \"c1\"");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);

test("search depth", function ($column, $output)
{

  expect((string) SQL::PostgreSQL->cte("cte", "SELECT *")->searchDepth($column, "c1"))
  ->toBe("\"cte\" AS (SELECT *) SEARCH DEPTH FIRST BY $output SET \"c1\"");

})
->with([
  ["c1", '"c1"'],
  [["c1", "c2"], '"c1", "c2"'],
]);