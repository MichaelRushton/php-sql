<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("for system time as of", function ($point_in_time)
{

  expect((string) SQL::MariaDB->table("t1")->forSystemTimeAsOf($point_in_time))
  ->toBe("`t1` FOR SYSTEM_TIME AS OF '2025-01-01 00:00:00'");

})
->with(["2025-01-01 00:00:00", new DateTime("2025-01-01 00:00:00")]);

test("for system time as of raw", function ()
{

  expect((string) SQL::MariaDB->table("t1")->forSystemTimeAsOfRaw("NOW()"))
  ->toBe("`t1` FOR SYSTEM_TIME AS OF NOW()");

});

test("for system time between", function ($start, $end)
{

  expect((string) SQL::MariaDB->table("t1")->forSystemTimeBetween($start, $end))
  ->toBe("`t1` FOR SYSTEM_TIME BETWEEN '2024-01-01 00:00:00' AND '2025-01-01 00:00:00'");

})
->with([
  ["2024-01-01 00:00:00", "2025-01-01 00:00:00"],
  [new DateTime("2024-01-01 00:00:00"), new DateTime("2025-01-01 00:00:00")],
]);

test("for system time between raw", function ()
{

  expect((string) SQL::MariaDB->table("t1")->forSystemTimeBetweenRaw("A", "B"))
  ->toBe("`t1` FOR SYSTEM_TIME BETWEEN A AND B");

});

test("for system time from", function ($start, $end)
{

  expect((string) SQL::MariaDB->table("t1")->forSystemTimeFrom($start, $end))
  ->toBe("`t1` FOR SYSTEM_TIME FROM '2024-01-01 00:00:00' TO '2025-01-01 00:00:00'");

})
->with([
  ["2024-01-01 00:00:00", "2025-01-01 00:00:00"],
  [new DateTime("2024-01-01 00:00:00"), new DateTime("2025-01-01 00:00:00")],
]);

test("for system time from raw", function ()
{

  expect((string) SQL::MariaDB->table("t1")->forSystemTimeFromRaw("A", "B"))
  ->toBe("`t1` FOR SYSTEM_TIME FROM A TO B");

});

test("for system time all", function ()
{

  expect((string) SQL::MariaDB->table("t1")->forSystemTimeAll())
  ->toBe("`t1` FOR SYSTEM_TIME ALL");

});