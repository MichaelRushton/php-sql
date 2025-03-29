<?php

declare(strict_types=1);

use MichaelRushton\SQL\Components\Upsert;
use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Insert;

test("on conflict do nothing", function ()
{

  expect(
    (string) (new Insert(SQL::SQLite))
    ->onConflictDoNothing()
    ->onConflictDoNothing(fn (Upsert $upsert) => $upsert->columns("c1"))
  )
  ->toBe("INSERT DEFAULT VALUES ON CONFLICT DO NOTHING ON CONFLICT (c1) DO NOTHING");

});

test("on conflict do update set", function ()
{

  expect(
    (string) $stmt = (new Insert(SQL::SQLite))
    ->onConflictDoUpdateSet("c1", 1, fn (Upsert $upsert) => $upsert->columns("c1"))
    ->onConflictDoUpdateSet([
      "c1" => 1,
      "c2" => 2,
    ], fn (Upsert $upsert) => $upsert->columns("c0"))
  )
  ->toBe(
    implode(" ", [
      "INSERT",
      "DEFAULT VALUES",
      "ON CONFLICT (c1) DO UPDATE SET c1 = ?",
      "ON CONFLICT (c0) DO UPDATE SET c1 = ?, c2 = ?",
    ])
  );

  expect($stmt->bindings())
  ->toBe([1, 1, 2]);

});