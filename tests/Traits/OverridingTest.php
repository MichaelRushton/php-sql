<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("overriding system value", function ()
{

  expect((string) SQL::PostgreSQL->insert()->overridingSystemValue())
  ->toBe("INSERT OVERRIDING SYSTEM VALUE DEFAULT VALUES");

});

test("overriding user value", function ()
{

  expect((string) SQL::PostgreSQL->insert()->overridingUserValue())
  ->toBe("INSERT OVERRIDING USER VALUE DEFAULT VALUES");

});