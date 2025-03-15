<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\MySQL\Insert;

test("insert", function ()
{

  expect(
    (string) (new Insert)
    ->lowPriority()
    ->highPriority()
    ->ignore()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->set("c1")
    ->select("SELECT *")
    ->as("new")
    ->onDuplicateKeyUpdate("c1")
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "INSERT",
    "LOW_PRIORITY",
    "HIGH_PRIORITY",
    "IGNORE",
    "INTO `t1`",
    "(`c1`)",
    "VALUES (?)",
    "SET `c1` = NULL",
    "SELECT *",
    "AS `new`",
    "ON DUPLICATE KEY UPDATE `c1` = NULL",
  ]));

});

test("insert default", function ()
{

  expect((string) new Insert)
  ->toBe("INSERT VALUES ()");

});