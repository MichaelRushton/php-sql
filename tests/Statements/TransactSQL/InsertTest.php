<?php

declare(strict_types=1);

use MichaelRushton\SQL\Statements\TransactSQL\Insert;

test("insert", function ()
{

  expect(
    (string) (new Insert)
    ->with("cte", "SELECT *")
    ->top(1)
    ->into("t1")
    ->columns("c1")
    ->output()
    ->values([1])
    ->select("SELECT *")
    ->when(true, fn () => true)
  )
  ->toBe(implode(" ", [
    "WITH [cte] AS (SELECT *)",
    "INSERT",
    "TOP (1)",
    "INTO [t1]",
    "([c1])",
    "OUTPUT INSERTED.*",
    "VALUES (?)",
    "SELECT *",
  ]));

});

test("insert default", function ()
{

  expect((string) new Insert)
  ->toBe("INSERT DEFAULT VALUES");

});