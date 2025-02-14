<?php

declare(strict_types=1);

use MichaelRushton\SQL\Services\Outfile;
use MichaelRushton\SQL\SQL;

test("fields terminated by", function ($string, $output)
{

  expect((string) (new Outfile(SQL::MariaDB, "path"))->fieldsTerminatedBy($string))
  ->toBe("'path' FIELDS TERMINATED BY '$output'");

})
->with([
  [",", ","],
  ["','", "'',''"],
]);

test("fields enclosed by", function ($string, $output)
{

  expect((string) (new Outfile(SQL::MariaDB, "path"))->fieldsEnclosedBy($string))
  ->toBe("'path' FIELDS ENCLOSED BY '$output'");

})
->with([
  ['"', '"'],
  ["'", "''"],
]);

test("fields optionally enclosed by", function ($string, $output)
{

  expect((string) (new Outfile(SQL::MariaDB, "path"))->fieldsOptionallyEnclosedBy($string))
  ->toBe("'path' FIELDS OPTIONALLY ENCLOSED BY '$output'");

})
->with([
  ['"', '"'],
  ["'", "''"],
]);

test("fields escaped by", function ($string, $output)
{

  expect((string) (new Outfile(SQL::MariaDB, "path"))->fieldsEscapedBy($string))
  ->toBe("'path' FIELDS ESCAPED BY '$output'");

})
->with([
  ["\\\\", "\\\\"],
  ["'", "''"],
]);

test("fields", function ()
{

  expect(
    (string) (new Outfile(SQL::MariaDB, "path"))
    ->fieldsTerminatedBy(",")
    ->fieldsEnclosedBy('"')
    ->fieldsOptionallyEnclosedBy('"')
    ->fieldsEscapedBy("\\\\")
  )
  ->toBe("'path' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\\\\'");

});