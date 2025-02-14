<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\SQLite\Select;

test("when if true", function ()
{

  expect((string) SQL::SQLite->select()->when(
    1,
    if_true: fn (Select $stmt, $condition) => $stmt->from("$condition"),
    if_false: fn (Select $stmt) => $stmt->from("2")
  ))
  ->toBe("SELECT * FROM \"1\"");

});

test("when if false", function ()
{

  expect((string) SQL::SQLite->select()->when(
    0,
    if_true: fn (Select $stmt) => $stmt->from("1"),
    if_false: fn (Select $stmt, $condition) => $stmt->from("$condition")
  ))
  ->toBe("SELECT * FROM \"0\"");

});