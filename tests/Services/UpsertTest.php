<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Upsert;
use MichaelRushton\SQL\SQL;

test("upsert", function ()
{

  expect(
    (string) (new Upsert(SQL::SQLite))
    ->columns("c1")
    ->whereIndex("c1")
    ->onConstraint("a")
    ->set("c1")
    ->where("c2")
  )
  ->toBe(implode(" ", [
    '("c1")',
    'WHERE "c1"',
    'ON CONSTRAINT "a"',
    "DO UPDATE",
    'SET "c1" = NULL',
    'WHERE "c2"',
  ]));

});

test("upsert do nothing", function ()
{

  expect((string) new Upsert(SQL::SQLite))
  ->toBe("DO NOTHING");

});