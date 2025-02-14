<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Outfile;
use MichaelRushton\SQL\SQL;

test("outfile", function ()
{

  expect(
    (string) (new Outfile(SQL::SQLite, "path"))
    ->characterSet("utf8")
    ->fieldsTerminatedBy(",")
    ->linesStartingBy("")
  )
  ->toBe(implode(" ", [
    "'path'",
    "CHARACTER SET utf8",
    "FIELDS TERMINATED BY ','",
    "LINES STARTING BY ''",
  ]));

});