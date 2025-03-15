<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\MariaDB\Replace;

test("replace", function ()
{

  expect(
    (string) (new Replace)
    ->lowPriority()
    ->delayed()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->set("c1")
    ->select("SELECT *")
    ->returning()
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "REPLACE",
    "LOW_PRIORITY",
    "DELAYED",
    "INTO `t1`",
    "(`c1`)",
    "VALUES (?)",
    "SET `c1` = NULL",
    "SELECT *",
    "RETURNING *",
  ]));

});

test("replace default", function ()
{

  expect((string) new Replace)
  ->toBe("REPLACE VALUES ()");

});