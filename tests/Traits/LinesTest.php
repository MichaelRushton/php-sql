<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Outfile;
use MichaelRushton\SQL\SQL;

test("lines starting by", function ($string, $output)
{

  expect((string) (new Outfile(SQL::MariaDB, "path"))->linesStartingBy($string))
  ->toBe("'path' LINES STARTING BY '$output'");

})
->with([
  [":", ":"],
  ["'", "''"],
]);

test("lines terminated by", function ($string, $output)
{

  expect((string) (new Outfile(SQL::MariaDB, "path"))->linesTerminatedBy($string))
  ->toBe("'path' LINES TERMINATED BY '$output'");

})
->with([
  ['\n', '\n'],
  ["'", "''"],
]);

test("lines", function ()
{

  expect(
    (string) (new Outfile(SQL::MariaDB, "path"))
    ->linesStartingBy(":")
    ->linesTerminatedBy('\n')
  )
  ->toBe('\'path\' LINES STARTING BY \':\' TERMINATED BY \'\n\'');

});