<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("sql cache", function ()
{

  expect((string) SQL::MariaDB->select()->sqlCache())
  ->toBe("SELECT SQL_CACHE *");

});

test("sql no cache", function ()
{

  expect((string) SQL::MariaDB->select()->sqlNoCache())
  ->toBe("SELECT SQL_NO_CACHE *");

});