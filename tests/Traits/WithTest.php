<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\CTE;
use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("with", function ($stmt, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->with("cte", $stmt, fn (CTE $cte) => $cte->materialized())
  )
  ->toBe("WITH cte AS MATERIALIZED (SELECT * WHERE c1 = ?) SELECT *");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["SELECT * WHERE c1 = ?"],
  [new Raw("SELECT * WHERE c1 = ?", 1), [1]],
  [fn (Select $stmt) => $stmt->where("c1", 1), [1]],
]);

test("recursive", function ()
{

  expect(
    (string) (new Select(SQL::SQLite))
    ->with("cte", "SELECT")
    ->recursive()
  )
  ->toBe("WITH RECURSIVE cte AS (SELECT) SELECT *");

});