<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Join;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("empty join", function ()
{

  expect((string) new Join(SQL::SQLite))
  ->toBe("");

});

test("single join", function ()
{

  expect(
    (string) (new Join(SQL::SQLite))
    ->on("c1")
  )
  ->toBe('"c1"');

});

test("multiple join", function ()
{

  expect(
    (string) (new Join(SQL::SQLite))
    ->on("c1")
    ->on("c2")
  )
  ->toBe('("c1" AND "c2")');

});

test("join has bindings", function ()
{

  expect(
    (string) $join = (new Join(SQL::SQLite))
    ->on(new Raw("?", 1))
  )
  ->toBe("?");

  expect($join->bindings())
  ->toBe([1]);

});