<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Having;
use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\SQL;

test("empty having", function ()
{

  expect((string) new Having(SQL::SQLite))
  ->toBe("");

});

test("single having", function ()
{

  expect(
    (string) (new Having(SQL::SQLite))
    ->having("c1")
  )
  ->toBe('"c1"');

});

test("multiple having", function ()
{

  expect(
    (string) (new Having(SQL::SQLite))
    ->having("c1")
    ->having("c2")
  )
  ->toBe('("c1" AND "c2")');

});

test("having has bindings", function ()
{

  expect(
    (string) $having = (new Having(SQL::SQLite))
    ->having(new Raw("?", 1))
  )
  ->toBe("?");

  expect($having->bindings())
  ->toBe([1]);

});