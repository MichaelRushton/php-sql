<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\Upsert;
use MichaelRushton\SQL\SQL;

test("on conflict", function ($on_conflict, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->insert()->onConflict($on_conflict))
  ->toBe("INSERT DEFAULT VALUES ON CONFLICT $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["DO NOTHING", "DO NOTHING"],
  [new Raw("?", 1), "?", [1]],
  [["DO NOTHING", "DO NOTHING"], "DO NOTHING ON CONFLICT DO NOTHING"],
]);

test("on conflict do nothing", function ()
{

  expect((string) SQL::SQLite->insert()->onConflictDoNothing(function (Upsert $upsert)
  {

  }))
  ->toBe("INSERT DEFAULT VALUES ON CONFLICT DO NOTHING");

});

test("on conflict do update set", function ($column, $value, $output, $bindings = [])
{

  expect((string) $stmt = SQL::SQLite->insert()->onConflictDoUpdateSet($column, $value, function (Upsert $upsert)
  {

  }))
  ->toBe("INSERT DEFAULT VALUES ON CONFLICT DO UPDATE SET $output");

  expect($stmt->bindings())
  ->toBe($bindings);

})
->with([
  ["c1", "test", '"c1" = ?', ["test"]],
  ["c1", new Raw("?", 1), '"c1" = ?', [1]],
  ["c1", 1, '"c1" = ?', [1]],
  ["c1", 1.1, '"c1" = ?', [1.1]],
  ["c1", true, '"c1" = ?', [true]],
  ["c1", null, '"c1" = NULL'],
  [["c1", "c2"], ["test1", "test2"], '("c1", "c2") = (?, ?)', ["test1", "test2"]],
]);

test("on conflict do update set array", function ()
{

  expect((string) $stmt = SQL::SQLite->insert()->onConflictDoUpdateSet([
    "c1" => "test1",
    "c2" => "test2",
  ], function (Upsert $upsert)
  {

  }))
  ->toBe('INSERT DEFAULT VALUES ON CONFLICT DO UPDATE SET "c1" = ?, "c2" = ?');

  expect($stmt->bindings())
  ->toBe(["test1", "test2"]);

});

test("on conflict do update set raw", function ($bindings)
{

  expect((string) $stmt = SQL::SQLite->insert()->onConflictDoUpdateSetRaw("c1", "?", $bindings, function (Upsert $upsert)
  {

  }))
  ->toBe('INSERT DEFAULT VALUES ON CONFLICT DO UPDATE SET "c1" = ?');

  expect($stmt->bindings())
  ->toBe((array) $bindings);

})
->with(["test", 1, 1.1, true, ["test", 1, 1.1, true]]);