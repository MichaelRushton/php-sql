<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Raw;
use MichaelRushton\SQL\Services\Where;
use MichaelRushton\SQL\SQL;

test("empty where", function ()
{

  expect((string) new Where(SQL::SQLite))
  ->toBe("");

});

test("single where", function ()
{

  expect(
    (string) (new Where(SQL::SQLite))
    ->where("c1")
  )
  ->toBe('"c1"');

});

test("multiple where", function ()
{

  expect(
    (string) (new Where(SQL::SQLite))
    ->where("c1")
    ->where("c2")
  )
  ->toBe('("c1" AND "c2")');

});

test("where has bindings", function ()
{

  expect(
    (string) $where = (new Where(SQL::SQLite))
    ->where(new Raw("?", 1))
  )
  ->toBe("?");

  expect($where->bindings())
  ->toBe([1]);

});