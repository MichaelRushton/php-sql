<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("or fail", function ()
{

  expect((string) SQL::SQLite->insert()->orFail())
  ->toBe("INSERT OR FAIL DEFAULT VALUES");

});

test("or ignore", function ()
{

  expect((string) SQL::SQLite->insert()->orIgnore())
  ->toBe("INSERT OR IGNORE DEFAULT VALUES");

});

test("or replace", function ()
{

  expect((string) SQL::SQLite->insert()->orReplace())
  ->toBe("INSERT OR REPLACE DEFAULT VALUES");

});

test("or rollback", function ()
{

  expect((string) SQL::SQLite->insert()->orRollBack())
  ->toBe("INSERT OR ROLLBACK DEFAULT VALUES");

});