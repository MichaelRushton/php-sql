<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\MariaDB\Insert;

test("insert", function ()
{

  expect(
    (string) (new Insert)
    ->lowPriority()
    ->delayed()
    ->highPriority()
    ->ignore()
    ->into("t1")
    ->columns("c1")
    ->values([1])
    ->set("c1")
    ->select("SELECT *")
    ->onDuplicateKeyUpdate("c1")
    ->returning()
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "INSERT",
    "LOW_PRIORITY",
    "DELAYED",
    "HIGH_PRIORITY",
    "IGNORE",
    "INTO `t1`",
    "(`c1`)",
    "VALUES (1)",
    "SET `c1` = NULL",
    "SELECT *",
    "ON DUPLICATE KEY UPDATE `c1` = NULL",
    "RETURNING *",
  ]));

});

test("insert default", function ()
{

  expect((string) new Insert)
  ->toBe("INSERT VALUES ()");

});