<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\MySQL\Replace;

test("replace", function ()
{

  expect(
    (string) (new Replace)
    ->lowPriority()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->set("c1")
    ->select("SELECT *")
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "REPLACE",
    "LOW_PRIORITY",
    "INTO `t1`",
    "(`c1`)",
    "VALUES (1)",
    "SET `c1` = NULL",
    "SELECT *",
  ]));

});

test("replace default", function ()
{

  expect((string) new Replace)
  ->toBe("REPLACE VALUES ()");

});