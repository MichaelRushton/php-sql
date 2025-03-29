<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\Components\Upsert;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("where index single column", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($upsert = new Upsert)
    ->whereIndex($column)
  )
  ->toBe("WHERE $expected DO NOTHING");

  expect($upsert->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "test", "c2" => 1], "c1 = ? AND c2 = ?", ["test", 1]],
]);

test("where index implicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($upsert = new Upsert)
    ->whereIndex("c1", $value)
  )
  ->toBe("WHERE c1 $expected DO NOTHING");

  expect($upsert->bindings())
  ->toBe($bindings);

})
->with([
  ["test", "= ?", ["test"]],
  [1, "= ?", [1]],
  [1.1, "= ?", [1.1]],
  [true, "= ?", [true]],
  [["test", 1], "= (?, ?)", ["test", 1]],
  [new Raw("?", "test"), "= ?", ["test"]],
  [new Select(SQL::SQLite), "= (SELECT *)"],
]);

test("where index explicit operator", function ($value, $expected, $bindings = [])
{

  expect(
    (string) ($upsert = new Upsert)
    ->whereIndex("c1", "!=", $value)
  )
  ->toBe("WHERE c1 != $expected DO NOTHING");

  expect($upsert->bindings())
  ->toBe($bindings);

})
->with([
  ["test", "?", ["test"]],
  [1, "?", [1]],
  [1.1, "?", [1.1]],
  [true, "?", [true]],
  [["test", 1], "(?, ?)", ["test", 1]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
]);

test("where index callback", function ($column, $expected, $bindings = [])
{

  expect(
    (string) ($upsert = new Upsert)
    ->whereIndex(function () use ($column)
    {
      $this->where($column);
    })
  )
  ->toBe("WHERE $expected DO NOTHING");

  expect($upsert->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "c1"],
  [1, "1"],
  [1.1, "1.1"],
  [true, "?", [true]],
  [new Raw("?", "test"), "?", ["test"]],
  [new Select(SQL::SQLite), "(SELECT *)"],
  [["c1" => "test", "c2" => 1], "(c1 = ? AND c2 = ?)", ["test", 1]],
]);