<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;
use MichaelRushton\SQL\Statements\Select;

test("sql cache", function ()
{

  expect(
    (string) (new Select(SQL::MariaDB))
    ->sqlCache()
  )
  ->toBe("SELECT SQL_CACHE *");

});

test("sql no cache", function ()
{

  expect(
    (string) (new Select(SQL::MariaDB))
    ->sqlNoCache()
  )
  ->toBe("SELECT SQL_NO_CACHE *");

});