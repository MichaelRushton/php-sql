<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("before system time", function ($point_in_time)
{

  expect((string) SQL::MariaDB->table("t1")->beforeSystemTime($point_in_time))
  ->toBe("`t1` BEFORE SYSTEM_TIME '2025-01-01 00:00:00'");

})
->with(["2025-01-01 00:00:00", new DateTime("2025-01-01 00:00:00")]);

test("before system time raw", function ()
{

  expect((string) SQL::MariaDB->table("t1")->beforeSystemTimeRaw("TRANSACTION 1"))
  ->toBe("`t1` BEFORE SYSTEM_TIME TRANSACTION 1");

});