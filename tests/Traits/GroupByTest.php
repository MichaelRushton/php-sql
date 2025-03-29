<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("group by", function ($column, $expected, $bindings = [])
{

  expect(
    (string) $stmt = (new Select(SQL::SQLite))
    ->groupBy($column)
  )
  ->toBe("SELECT * GROUP BY $expected");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [new Raw("?", 1), "?", [1]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1", "c2"], "c1, c2"],
]);

test("with rollup", function ()
{

  expect(
    (string) (new Select(SQL::SQLite))
    ->groupBy("c1")
    ->withRollup()
  )
  ->toBe("SELECT * GROUP BY c1 WITH ROLLUP");

});