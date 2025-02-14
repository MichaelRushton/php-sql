<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Window;
use MichaelRushton\SQL\SQL;

test("window", function ($sql, $output)
{

  expect((string) $sql->select()->window("w", function (Window $window)
  {

  }))
  ->toBe("SELECT * WINDOW $output AS ()");

})
->with([
  [SQL::MySQL, "`w`"],
  [SQL::PostgreSQL, '"w"'],
  [SQL::SQLite, '"w"'],
  [SQL::TransactSQL, "[w]"],
]);

test("multiple windows", function ()
{

  expect(
    (string) SQL::SQLite->select()
    ->window("w1")
    ->window("w2")
  )
  ->toBe('SELECT * WINDOW "w1" AS (), "w2" AS ()');

});