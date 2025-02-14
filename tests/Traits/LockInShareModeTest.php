<?php

declare(strict_types=1);

use MichaelRushton\SQL\SQL;

test("lock in share mode", function ()
{

  expect((string) SQL::MariaDB->select()->lockInShareMode())
  ->toBe("SELECT * LOCK IN SHARE MODE");

});

test("lock in share mode wait", function ()
{

  expect((string) SQL::MariaDB->select()->lockInShareModeWait(1))
  ->toBe("SELECT * LOCK IN SHARE MODE WAIT 1");

});

test("lock in share mode nowait", function ()
{

  expect((string) SQL::MariaDB->select()->lockInShareModeNoWait())
  ->toBe("SELECT * LOCK IN SHARE MODE NOWAIT");

});

test("lock in share mode skip locked", function ()
{

  expect((string) SQL::MariaDB->select()->lockInShareModeSkipLocked())
  ->toBe("SELECT * LOCK IN SHARE MODE SKIP LOCKED");

});